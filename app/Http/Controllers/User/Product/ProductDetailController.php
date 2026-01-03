<?php

namespace App\Http\Controllers\User\Product;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        try {
            $product = Product::with([
                'category',
                'images',
                'sizes',
                'colors.images',
                'reviews.user'
            ])->findOrFail($id);

            $featuredProducts = Product::with(['images', 'category'])
                ->where('is_active', true)
                ->where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(4)
                ->get();

            // Get cart count
            $cartCount = $this->getCartCount();

            return view('user.product-detail', compact('product', 'featuredProducts', 'cartCount'));
            
        } catch (\Exception $e) {
            Log::error('Product detail error: ' . $e->getMessage());
            abort(404);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'size_id' => 'nullable|exists:product_sizes,id',
                'color_id' => 'nullable|exists:product_colors,id',
                'quantity' => 'required|integer|min:1|max:10'
            ]);

            $product = Product::findOrFail($request->product_id);
            
            // Check if user is authenticated
            if (Auth::check()) {
                $userId = Auth::id();
                $guestToken = null;
            } else {
                $userId = null;
                $guestToken = $this->getOrCreateGuestToken();
            }

            // Calculate price
            $price = $product->final_price;
            
            // If size is selected, check its price
            if ($request->size_id) {
                $size = ProductSize::find($request->size_id);
                if ($size && $size->price) {
                    $price = $size->price;
                }
            }

            // Check if item already exists in cart
            $existingCartItem = Cart::where(function($query) use ($userId, $guestToken) {
                    if ($userId) {
                        $query->where('user_id', $userId);
                    } else {
                        $query->where('guest_token', $guestToken);
                    }
                })
                ->where('product_id', $request->product_id)
                ->where('size_id', $request->size_id)
                ->where('color_id', $request->color_id)
                ->first();

            if ($existingCartItem) {
                // Update quantity
                $existingCartItem->increment('quantity', $request->quantity);
                $existingCartItem->update([
                    'price' => $price,
                    'total' => $price * $existingCartItem->quantity
                ]);
            } else {
                // Create new cart item
                Cart::create([
                    'user_id' => $userId,
                    'guest_token' => $guestToken,
                    'product_id' => $request->product_id,
                    'size_id' => $request->size_id,
                    'color_id' => $request->color_id,
                    'quantity' => $request->quantity,
                    'price' => $price,
                    'total' => $price * $request->quantity,
                    'item_name' => $product->name,
                    'color_name' => $request->color_id ? ProductColor::find($request->color_id)->name : null,
                    'size_name' => $request->size_id ? ProductSize::find($request->size_id)->name : null,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $this->getCartCount()
            ]);

        } catch (\Exception $e) {
            Log::error('Add to cart error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart.'
            ], 500);
        }
    }

/**
 * Helper to get or create a consistent string-based guest token
 */
private function getOrCreateGuestToken()
{
    $token = session('guest_token');

    if (!$token) {
        $token = (string) \Illuminate\Support\Str::uuid();
        session(['guest_token' => $token]);
    }

    return is_object($token) ? (string) $token : $token;
} 


public function buyNow(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'size_id' => 'nullable|exists:product_sizes,id',
                'color_id' => 'nullable|exists:product_colors,id',
                'quantity' => 'required|integer|min:1|max:10'
            ]);

            // First add to cart
            $cartResponse = $this->addToCart($request);
            $data = json_decode($cartResponse->getContent(), true);

            if ($data['success']) {
                // Redirect to checkout
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('checkout.index')
                ]);
            }

            throw new \Exception('Failed to add to cart');

        } catch (\Exception $e) {
            Log::error('Buy now error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process buy now.'
            ], 500);
        }
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000'
        ]);

        $product = Product::findOrFail($id);

        // Check if user has purchased the product
        if (!$product->currentUserHasPurchased()) {
            return redirect()->back()->with('error', 'You need to purchase this product before reviewing.');
        }

        // Check if user already reviewed
        if ($product->currentUserHasReviewed()) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        // Update product rating
        $avgRating = Review::where('product_id', $id)->avg('rating');
        $product->update(['rating' => $avgRating]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $guestToken = Cookie::get('guest_token');
            return $guestToken ? Cart::where('guest_token', $guestToken)->sum('quantity') : 0;
        }
    }

    public function getCartCountApi()
    {
        return response()->json(['count' => $this->getCartCount()]);
    }



    public function quickAddToCart($productId)
    {
        try {
            $product = Product::findOrFail($productId);

            if (Auth::check()) {
                $userId = Auth::id();
                $guestToken = null;
            } else {
                $userId = null;
                $guestToken = $this->getOrCreateGuestToken();
            }

            Cart::create([
                'user_id' => $userId,
                'guest_token' => $guestToken,
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->final_price,
                'total' => $product->final_price,
                'item_name' => $product->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cart_count' => $this->getCartCount()
            ]);

        } catch (\Exception $e) {
            Log::error('Quick add to cart error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart.'
            ], 500);
        }
    }
}