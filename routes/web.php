<?php

use App\Models\User;
use App\Http\Controllers\User\Auth\UserRegisterController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Partial\NavbarController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\User\Checkout\CheckoutController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Product\ProductDetailController;

// Add this route to your web.php file
Route::get('/categories-with-products', [ProductController::class, 'getCategoriesWithProducts'])->name('categories.with.products');


Route::get('login', [UserLoginController::class, 'index'])->name('login.show');
Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');


Route::get('register', [UserRegisterController::class, 'index'])->name('register.show');
Route::post('register', [UserRegisterController::class, 'register'])->name('user.register');

Route::get('/email/verify', function () {
    return view('user.auth.verify-notice');
})->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $user = User::find($request->route('id'));

    if (!$user) {
        abort(404, 'User not found');
    }

    if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
        abort(403, 'Invalid verification link');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('home')->with('info', 'Email already verified.');
    }

    $user->markEmailAsVerified();
    $user->update(['is_approved' => true]);

    event(new Verified($user));

    Auth::login($user);

    return redirect()->route('home')->with('success', 'Email verified successfully!');
})->middleware(['signed'])->name('verification.verify');


Route::post('/email/resend', function (Request $request) {
    $user = Auth::user();

    if ($user->last_verification_sent && $user->last_verification_sent->diffInSeconds(now()) < 60) {
        return back()->with('error', 'Please wait 1 minute before resending.');
    }

    $user->sendEmailVerificationNotification();
    $user->update(['last_verification_sent' => now()]);

    return back()->with('success', 'Verification link resent!');
})->name('verification.resend');

// Forgot Password Form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


//RESET PASWORD
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::get('/product',[ProductController::class, 'index'])->name('product');

// HOME 
Route::get('popular-products', [NavbarController::class, 'index']);
Route::get('/search-products', [NavbarController::class, 'search']);

Route::get('/product/{id}', [ProductDetailController::class, 'show'])->name('product.show');
Route::post('/product/{id}/review', [ProductDetailController::class, 'store'])->name('review.store');
// Add this line to your routes/web.php
Route::get('/products/load-more/{category}', [ProductController::class, 'loadMoreProducts'])
     ->name('products.load-more');
Route::post('add-to-cart', [ProductDetailController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/buy-now', [ProductDetailController::class, 'buyNow']);
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/placeOrder', [CheckoutController::class , 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order/confirmation/{order}', [CheckoutController::class, 'confirmation'])
->name('order.confirmation');

// Invoice download (can be accessed by user)
Route::get('/order/invoice/{order}/download', [CheckoutController::class, 'downloadInvoice'])
->name('order.invoice.download');

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about',[AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class , 'index'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/category', [CategoryController::class, 'index'])->name('category');