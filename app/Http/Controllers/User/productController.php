<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $allCategories = Category::all();
    
        $minPrice = Product::min('price') ?? 0;
        $maxPrice = Product::max('price') ?? 200;
    
        $defaultPrice = $request->price ?? $maxPrice;
    
        $categoriesQuery = Category::query();
    
        if ($request->categories) {
            $categoryIds = array_filter(explode(',', $request->categories));
            if (!empty($categoryIds)) {
                $categoriesQuery->whereIn('id', $categoryIds);
            }
        }
    
        $productFilterClosure = function($productQuery) use ($request) {
            if ($request->price) {
                $productQuery->where('price', '<=', $request->price);
            }
            
            if ($request->ratings) {
                $ratingValues = array_filter(explode(',', $request->ratings));
                if (!empty($ratingValues)) {
                    $minRating = min($ratingValues);
                    $productQuery->where('rating', '>=', $minRating);
                }
            }
        };
    
        $categoriesQuery
            ->with(['product' => function($query) use ($productFilterClosure) {
                $productFilterClosure($query); 
                $query->take(4); 
                $query->with('defaultImage', 'colors.images', 'sizes');
            }])
            ->withCount([
                'product as filtered_products_count' => $productFilterClosure
            ]);
    
        $categories = $categoriesQuery->get();
    
        $categories = $categories->filter(fn($category) => $category->filtered_products_count > 0);
        
        if ($request->ajax()) {
            return view('user.partials.category_sections', compact('categories', 'allCategories', 'minPrice', 'maxPrice', 'defaultPrice'))->render();
        }
    
        return view('user.products', compact('categories', 'allCategories', 'minPrice', 'maxPrice', 'defaultPrice'));
    }


    public function loadMoreProducts(Request $request, Category $category)
{
    $productFilterClosure = function($productQuery) use ($request) {
        if ($request->price) {
            $productQuery->where('price', '<=', $request->price);
        }
        
        if ($request->ratings) {
            $ratingValues = array_filter(explode(',', $request->ratings));
            if (!empty($ratingValues)) {
                $minRating = min($ratingValues);
                $productQuery->where('rating', '>=', $minRating);
            }
        }
    };

    
    $products = $category->product()
                         ->with('defaultImage', 'colors.images', 'sizes')
                         ->where($productFilterClosure)
                         ->skip(4) 
                         ->take(1000) 
                         ->get();

    if ($products->isEmpty()) {
        return response()->json(['html' => '', 'noMore' => true]);
    }

    $html = '';
    foreach ($products as $product) {
        $html .= view('user.partials.product_cards', compact('product'))->render();
    }

    return response()->json([
        'html' => $html,
        'noMore' => true
    ]);
}
}