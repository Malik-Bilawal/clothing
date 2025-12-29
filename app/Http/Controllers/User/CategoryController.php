<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('product')->where('status', 1)->get();
    
        $products = Product::where('is_active', 1)->take(12)->get();
        return view('user.category', compact('categories','products'));
    }
}
