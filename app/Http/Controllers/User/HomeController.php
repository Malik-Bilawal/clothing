<?php

namespace App\Http\Controllers\User;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HeroSlider;

class HomeController extends Controller
{
    public function index(){

        $products = Product::with('defaultImage', 'images', 'colors.images', 'sizes')->take('8')->get();
        $sale = Sale::where('is_active', 1)->get();

        $categories = Category::where('status', 1)->get();
        $banners = HeroSlider::where('status', 1)->get();              
        return view('user.home', compact('categories', 'banners','products', 'sale'));
    }
}
