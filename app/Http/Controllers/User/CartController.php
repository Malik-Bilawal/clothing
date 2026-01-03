<?php

namespace App\Http\Controllers\User;

use session;
use App\Models\Cart;
use App\Models\Sale;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // 1. Get a clean string version of the guest token
        $sessionToken = $this->getOrCreateGuestToken();
    
        // 2. If Logged In: Merge guest items to this user
        if (Auth::check()) {
            $userId = Auth::id();
            
            // Move items from guest_token to user_id
            Cart::where('guest_token', $sessionToken)
                ->whereNull('user_id')
                ->update([
                    'user_id' => $userId,
                    'guest_token' => null // Optional: clear token in DB after merge
                ]);
                
            // Final query uses user_id
            $query = Cart::where('user_id', $userId);
        } else {
            // Final query uses guest_token
            $query = Cart::where('guest_token', $sessionToken);
        }
    
        // 3. Get items and filter out those with missing products
        $cartItems = $query->with([
            'product' => fn($q) => $q->with(['images', 'sizes', 'colors'])
        ])->get()->filter(fn($item) => $item->product !== null);
    
        // 4. Get active sales
        $activeSale = Sale::where('starts_at', '<=', now())
                          ->where('ends_at', '>=', now())
                          ->first();
    
        return view('user.cart', compact('cartItems', 'activeSale'));
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

    // Get guest token from multiple sources
    $guestToken = $this->getOrCreateGuestToken();

    Log::info('🔹 [Update Quantity Started]', [
        'cart_id' => $id,
        'user_id' => $userId,
        'guest_token' => $guestToken,
        'action' => $action,
        'input' => $request->all(),
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
        Log::error('❌ [Cart Not Found]', [
            'cart_id' => $id,
            'user_id' => $userId,
            'guest_token' => $guestToken
        ]);
        return response()->json(['error' => 'Cart not found'], 404);
    }

    Log::info('🛒 [Cart Found]', [
        'cart_id' => $cart->id,
        'current_quantity' => $cart->quantity,
        'product_id' => $cart->product_id,
        'price' => $cart->price,
        'stock_quantity' => $cart->product->stock_quantity ?? 'N/A'
    ]);

    // Handle increase/decrease
    if ($action === 'increase') {
        $maxQuantity = $cart->product->stock_quantity ?? 10;
        Log::info('🔼 [Increase Action]', [
            'current_quantity' => $cart->quantity,
            'max_quantity_allowed' => min($maxQuantity, 10)
        ]);

        if ($cart->quantity < $maxQuantity && $cart->quantity < 10) {
            $cart->quantity++;
            Log::info('✅ [Quantity Increased]', ['new_quantity' => $cart->quantity]);
        } else {
            Log::warning('⚠️ [Cannot Increase Quantity]', [
                'current_quantity' => $cart->quantity,
                'max_allowed' => min($maxQuantity, 10)
            ]);
            return response()->json([
                'error' => 'Cannot increase quantity',
                'max_quantity' => min($maxQuantity, 10)
            ], 400);
        }
    } elseif ($action === 'decrease') {
        Log::info('🔽 [Decrease Action]', ['current_quantity' => $cart->quantity]);
        if ($cart->quantity > 1) {
            $cart->quantity--;
            Log::info('✅ [Quantity Decreased]', ['new_quantity' => $cart->quantity]);
        } else {
            Log::warning('⚠️ [Cannot Decrease Quantity Below 1]', ['current_quantity' => $cart->quantity]);
            return response()->json([
                'error' => 'Cannot decrease quantity below 1'
            ], 400);
        }
    } else {
        Log::warning('⚠️ [Invalid Action]', ['action' => $action]);
        return response()->json(['error' => 'Invalid action'], 400);
    }

    // Recalculate total
    $cart->total = $cart->price * $cart->quantity;
    $cart->save();

    Log::info('💰 [Cart Updated]', [
        'cart_id' => $cart->id,
        'new_quantity' => $cart->quantity,
        'new_total' => $cart->total
    ]);

    return response()->json([
        'success' => true, 
        'quantity' => $cart->quantity,
        'item_total' => number_format($cart->total, 2)
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