<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\ContactMessagesController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::name('admin.')->group(function () {

    //Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    //SLIDER MANAGEME
    Route::get('/hero-sliders', [HeroSliderController::class, 'index'])->name('sliders');
    Route::post('hero-sliders/store', [HeroSliderController::class, 'store'])->name('hero-sliders.store');
    Route::put('hero-sliders/update/{heroSlider}', [HeroSliderController::class, 'update'])->name('hero-sliders.update');
    Route::delete('hero-sliders/delete/{heroSlider}', [HeroSliderController::class, 'destroy'])->name('hero-sliders.destroy');


    //Sale 
    Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
    Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');
    Route::delete('/sales/delete/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');
    Route::get('/sales/active', [SalesController::class, 'active'])->name('sales.active');


    //user
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //Product
    Route::get('product', [ProductController::class, 'index'])->name('products');
    Route::get('product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    //Order
     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
     Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
     Route::post('/orders/{order}/ship', [OrderController::class, 'ship'])->name('order.ship');
     Route::patch('/order/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
     Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');

     //Contact Messages

     Route::get('contact', [ContactMessagesController::class, 'index'])->name('contact');
Route::get('contact/destroy/{id}', [ContactMessagesController::class, 'destroy'])->name('contact.destroy');

});



