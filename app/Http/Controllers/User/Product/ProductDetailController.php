<?php

namespace App\Http\Controllers\User\Product;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductDetailController extends Controller
{
    public function show($id)
    {

        $featuredProducts = Product::all();
        $product = Product::with([
            'category',
            'images',
            'sizes',
            'colors.images'
        ])->findOrFail($id);
    
        return view('user.product-detail', compact('product', 'featuredProducts'));
    }



public function addToCart(Request $request)
{

    try {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:product_sizes,id', 
            'color_id' => 'required|exists:product_colors,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);


        $product = Product::findOrFail($request->product_id);
        $size = ProductSize::findOrFail($request->size_id);
        $color = ProductColor::findOrFail($request->color_id);

        $quantity = $request->quantity;
        $price = $size->price ?? $product->price;
        $total = $price * $quantity;

        if (Auth::check()) {
            $userId = Auth::id();
            $guestToken = null;
        } else {
            $userId = null;
            $guestToken = session('guest_token') 
                ?? Cookie::get('guest_token') 
                ?? Str::uuid();

            session(['guest_token' => $guestToken]);
            Cookie::queue(Cookie::make('guest_token', $guestToken, 60 * 24 * 30));

        }

        $existing = Cart::where(function ($query) use ($userId, $guestToken) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('guest_token', $guestToken);
                }
            })
            ->where('product_id', $product->id)
            ->where('size_id', $size->id)
            ->where('color_id', $color->id)
            ->first();

        if ($existing) {
            $existing->quantity += $quantity;
            $existing->total = $existing->price * $existing->quantity;
            $existing->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'guest_token' => $guestToken,
                'product_id' => $product->id,
                'size_id' => $size->id,
                'color_id' => $color->id,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $total,
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!'
        ]);
            } catch (\Exception $e) {


        return response()->json([
            'error' => 'Something went wrong while adding to cart',
            'details' => $e->getMessage()
        ], 500);
    }
}


public function buyNow(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        'size_id'    => 'nullable|exists:product_sizes,id',
        'color_id'   => 'nullable|exists:product_colors,id',
        'price'      => 'required|numeric',
    ]);

    $product = Product::with(['images', 'sizes', 'colors'])->findOrFail($request->product_id);

    $size  = $request->size_id ? $product->sizes->find($request->size_id) : null;
    $color = $request->color_id ? $product->colors->find($request->color_id) : null;
    
    $price = $size?->price ?? $product->price;
    
    session([
        'buy_now_item' => [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $price, // ✅ Correct price now
            'quantity'   => $request->quantity,
            'size_id'    => $size?->id,
            'size_name'  => $size?->name,
            'color_id'   => $color?->id,
            'color_name' => $color?->name,
            'image'      => $product->images->first()?->image_path,
        ],
    ]);
    

    return response()->json(['success' => true]);
}


//reiew
public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (!Auth::check()) {
            return back()->with('error', 'Login required.');
        }

        if (!$product->currentUserHasPurchased()) {
            return back()->with('error', 'Only verified buyers can review this product.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Review published successfully!');
    }
}