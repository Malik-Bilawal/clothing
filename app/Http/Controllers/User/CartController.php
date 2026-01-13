<?php

namespace App\Http\Controllers\User;

use session;
use App\Models\Cart;
use App\Models\Sale;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $sessionToken = $this->getOrCreateGuestToken();
    
        if (Auth::check()) {
            $userId = Auth::id();
            
            Cart::where('guest_token', $sessionToken)
                ->whereNull('user_id')
                ->update([
                    'user_id' => $userId,
                    'guest_token' => null 
                ]);
                
            $query = Cart::where('user_id', $userId);
        } else {
            $query = Cart::where('guest_token', $sessionToken);
        }
    
        $cartItems = $query->with([
            'product' => fn($q) => $q->with(['images', 'sizes', 'colors'])
        ])->get()->filter(fn($item) => $item->product !== null);
    
        $now = Carbon::now();
        $activeSale = Sale::where('is_active', true)
            ->where(function($q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function($q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            })
            ->orderBy('discount_percent', 'desc')
            ->first();
    
        // Calculate Totals & Discounts for the View
        $grandTotal = 0;
        $totalSaved = 0;
    
        // We transform the collection to add temporary properties for the view
        $cartItems->transform(function($cart) use ($activeSale) {
            $basePrice = $cart->price; 
            
            // Default values (No Sale)
            $finalUnitPrice = $basePrice;
            $cart->discount_percent = 0;
            $cart->is_sale_applied = false;
    
            // Apply Sale Calculation
            if ($activeSale) {
                $cart->discount_percent = $activeSale->discount_percent;
                $cart->is_sale_applied = true;
                
                $discountAmount = $basePrice * ($activeSale->discount_percent / 100);
                $finalUnitPrice = $basePrice - $discountAmount;
            }
    
            $cart->final_unit_price = $finalUnitPrice;
            $cart->original_line_total = $basePrice * $cart->quantity;
            $cart->final_line_total = $finalUnitPrice * $cart->quantity;
            
            $cart->line_saved_amount = $cart->original_line_total - $cart->final_line_total;
    
            return $cart;
        });
    
        $grandTotal = $cartItems->sum('final_line_total');
        $totalSaved = $cartItems->sum('line_saved_amount');
    
        return view('user.cart', compact('cartItems', 'activeSale', 'grandTotal', 'totalSaved'));
    }

    private function getOrCreateGuestToken()
    {
        $token = session('guest_token');

        if (!$token) {
            $token = (string) \Illuminate\Support\Str::uuid();
            session(['guest_token' => $token]);
        }

        return is_object($token) ? (string) $token : $token;
    }

    public function updateQuantity(Request $request, $id)
    {
        $action = $request->input('action');
        $userId = auth()->id();
        $guestToken = $this->getOrCreateGuestToken();

        Log::info('🔹 [Update Quantity Started]', [
            'cart_id' => $id,
            'user_id' => $userId,
            'action' => $action
        ]);

        // Fetch cart item
        $cart = Cart::where('id', $id)
            ->where(function ($query) use ($userId, $guestToken) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('guest_token', $guestToken);
                }
            })
            ->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $maxQuantity = $cart->product->stock_quantity ?? 10;
        
        if ($action === 'increase') {
            if ($cart->quantity < $maxQuantity && $cart->quantity < 10) {
                $cart->quantity++;
            } else {
                return response()->json(['error' => 'Cannot increase quantity'], 400);
            }
        } elseif ($action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->quantity--;
            } else {
                return response()->json(['error' => 'Cannot decrease quantity below 1'], 400);
            }
        } else {
            return response()->json(['error' => 'Invalid action'], 400);
        }

        $now = Carbon::now();
        
        $activeSale = Sale::where('is_active', true)
            ->where(function($q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function($q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            })
            ->orderBy('discount_percent', 'desc') 
            ->first();

        $baseUnitPrice = $cart->price; 
        $finalUnitPrice = $baseUnitPrice;
        $discountPercent = 0;
        $isSaleApplied = false;

        if ($activeSale) {
            $isSaleApplied = true;
            $discountPercent = $activeSale->discount_percent;
            
            $discountAmountPerItem = $baseUnitPrice * ($discountPercent / 100);
            $finalUnitPrice = $baseUnitPrice - $discountAmountPerItem;
        }

        $cart->total = $finalUnitPrice * $cart->quantity;
        $cart->save();

        $originalTotal = $baseUnitPrice * $cart->quantity;
        $savedAmount = $originalTotal - $cart->total;

        Log::info('💰 [Cart Updated with Sale]', [
            'cart_id' => $cart->id,
            'quantity' => $cart->quantity,
            'sale_applied' => $isSaleApplied,
            'discount_percent' => $discountPercent,
            'final_total' => $cart->total
        ]);

        return response()->json([
            'success' => true,
            'quantity' => $cart->quantity,
            'item_total' => number_format($cart->total, 2),
            'is_sale_active' => $isSaleApplied,
            'discount_percent' => $discountPercent,
            'original_total' => number_format($originalTotal, 2), 
            'saved_amount' => number_format($savedAmount, 2),
        ]);
    }

    public function remove($id)
    {
        $userId = auth()->id();
        $guestToken = session('guest_token') ?? request()->cookie('guest_token');
        
        \Log::info('Remove Cart Item:', [
            'cart_id' => $id,
            'user_id' => $userId,
            'guest_token' => $guestToken
        ]);

        $cart = Cart::where('id', $id)
            ->where(function ($query) use ($userId, $guestToken) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('guest_token', $guestToken);
                }
            })
            ->first();

        if (!$cart) {
            \Log::error('Cart not found for removal:', [
                'cart_id' => $id,
                'user_id' => $userId,
                'guest_token' => $guestToken
            ]);
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $cart->delete();
        
        \Log::info('Cart item removed:', ['cart_id' => $id]);

        return response()->json(['success' => true]);
    }

    public function getCartCount()
    {
        $userId = auth()->id();
        $guestToken = session('guest_token') ?? request()->cookie('guest_token');
        
        $query = Cart::query();
        
        if ($userId) {
            $query->where('user_id', $userId);
        } elseif ($guestToken) {
            $query->where('guest_token', $guestToken);
        } else {
            return response()->json(['count' => 0]);
        }
        
        $count = $query->sum('quantity');
        
        \Log::info('Cart count:', [
            'user_id' => $userId,
            'guest_token' => $guestToken,
            'count' => $count
        ]);
        
        return response()->json(['count' => $count]);
    }

    public function debugCart()
    {
        // This is a debug method to check what's in the database
        $allCarts = Cart::with('product')->get();
        
        $userId = auth()->id();
        $guestToken = session('guest_token') ?? request()->cookie('guest_token');
        
        $userCarts = $userId 
            ? Cart::where('user_id', $userId)->get() 
            : ($guestToken 
                ? Cart::where('guest_token', $guestToken)->get() 
                : collect());
        
        return response()->json([
            'all_carts' => $allCarts->toArray(),
            'user_carts' => $userCarts->toArray(),
            'session_guest_token' => session('guest_token'),
            'cookie_guest_token' => request()->cookie('guest_token'),
            'auth_user_id' => $userId
        ]);
    }
}