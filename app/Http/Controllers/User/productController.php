<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $allCategories = Category::withCount('products')->get();
    
        $minPrice = Product::min('price') ?? 0;
        $maxPrice = Product::max('price') ?? 2000;
        $defaultPrice = $request->price ?? $maxPrice;
        
        // Get grid preference from cookie or default to 3
        $gridPreference = $request->cookie('grid_preference') ?? 3;
        
        // Build query for products
        $productsQuery = Product::query()->with('reviews');
    
        // Filter by categories
        if ($request->categories) {
            $categoryIds = array_filter(explode(',', $request->categories));
            if (!empty($categoryIds)) {
                $productsQuery->whereIn('category_id', $categoryIds);
            }
        }
    
        // Price filter
        if ($request->price && $request->price > 0) {
            $productsQuery->where(function($q) use ($request) {
                $q->where('price', '<=', $request->price);
            });
        }
        
        // Rating filter
        if ($request->ratings) {
            $ratingValues = array_filter(explode(',', $request->ratings));
            if (!empty($ratingValues)) {
                $minRating = min($ratingValues);
                $productsQuery->whereHas('reviews', function($q) use ($minRating) {
                    $q->selectRaw('product_id, AVG(rating) as avg_rating')
                      ->groupBy('product_id')
                      ->having('avg_rating', '>=', $minRating);
                });
            }
        }
        
        // Sort options
        switch ($request->sort) {
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'rating':
                $productsQuery->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            case 'newest':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            default:
                $productsQuery->orderBy('created_at', 'desc');
                break;
        }
    
        // Fetch products with relationships - 12 per page for Load More
        $products = $productsQuery
            ->with(['images' => function($q) {
                $q->where('is_default', true)->orWhere('is_default', null)->limit(1);
            }, 'colors.images', 'sizes', 'category', 'reviews'])
            ->paginate(12);
    
        $totalProducts = $products->total();
        
        // Calculate average ratings
        foreach ($products as $product) {
            $product->rating = $product->reviews->avg('rating') ?? 0;
            $product->reviews_count = $product->reviews->count();
        }
        
        // For AJAX requests (Load More), return only the product items
        if ($request->ajax()) {
            return response()->json([
                'html' => view('user.partials.product_grid_items', [
                    'products' => $products,
                    'gridPreference' => $gridPreference
                ])->render(),
                'hasMore' => $products->hasMorePages(),
                'nextPage' => $products->currentPage() + 1
            ]);
        }
    
        return view('user.products', compact(
            'products', 
            'allCategories', 
            'minPrice', 
            'maxPrice', 
            'defaultPrice',
            'gridPreference',
            'totalProducts'
        ));
    }
    
    public function setGridPreference(Request $request)
    {
        $validated = $request->validate([
            'grid' => 'required|in:2,3,4'
        ]);
        
        $cookie = cookie('grid_preference', $validated['grid'], 60*24*365); // 1 year
        
        return response()->json(['success' => true])->withCookie($cookie);
    }
    
    public function quickView($id)
    {
        $product = Product::with(['images', 'colors.images', 'sizes', 'category', 'reviews'])
            ->findOrFail($id);
            
        return view('user.partials.quick_view_modal', compact('product'));
    }

    public function addToCartModal($id)
    {
        Log::info('AddToCartModal called', [
            'product_id' => $id,
            'url' => request()->fullUrl(),
        ]);
    
        try {
            $product = Product::with(['images', 'colors', 'sizes'])
                ->findOrFail($id);
    
            Log::info('Product found for AddToCartModal', [
                'product_id' => $product->id,
                'name' => $product->name ?? null,
            ]);
    
            return view('user.partials.add_to_cart_modal', compact('product'));
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Product not found for AddToCartModal', [
                'product_id' => $id,
            ]);
    
            abort(404);
    
        } catch (\Throwable $e) {
            Log::error('Error loading AddToCartModal', [
                'product_id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            abort(500, 'Failed to load product');
        }
    }
}