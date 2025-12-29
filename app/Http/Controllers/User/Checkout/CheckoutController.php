<?php

namespace App\Http\Controllers\User\Checkout;

use App\Models\Cart;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ProductSize;
use App\Models\OrderAddress;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\AdminOrderAlertMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;

class CheckoutController extends Controller
{
    public function index(Request $request)
{
    $shipping = 250;
    $tax = 0;
    $cartItems = collect();
    $source = $request->query('source', 'cart');

    if ($source !== 'buy_now') {
        session()->forget('buy_now_item');
    }

    if ($source === 'buy_now' && session()->has('buy_now_item')) {
        $buyNow = session('buy_now_item');

        $product = Product::with(['images', 'defaultImage','sizes', 'colors'])->find($buyNow['product_id']);

        if ($product) {
            $size = isset($buyNow['size_id'])
                ? ProductSize::find($buyNow['size_id'])
                : null;
            $color = isset($buyNow['color_id'])
                ? ProductColor::find($buyNow['color_id'])
                : null;

            $cartItems->push((object)[
                'id'        => null,
                'product'   => $product,
                'quantity'  => $buyNow['quantity'] ?? 1,
                'size'      => $size,
                'color'     => $color,
                'price'     => $buyNow['price'] ?? $product->price,
                'name'      => $product->name,
                'image'     => optional($product->images->first())->image_path,
                'from'      => 'buy_now',
            ]);
        }

        return view('user.checkout.checkout', compact('cartItems', 'shipping', 'tax'));
    }

    $cart = collect();

    if (Auth::check()) {
        $cart = Cart::where('user_id', Auth::id())
            ->with(['product.images', 'size', 'color'])
            ->get();
    } else {
        $guestToken = session('guest_token') ?? Cookie::get('guest_token');

        if ($guestToken) {
            $cart = Cart::where('guest_token', $guestToken)
                ->with(['product.images', 'product.defaultImage', 'product.sizes', 'product.colors'])
                ->get();
        }
    }

    foreach ($cart as $item) {
        if ($item->product) {
            $cartItems->push((object)[
                'id'        => $item->id,
                'product'   => $item->product,
                'quantity'  => $item->quantity,
                'size'      => $item->size,
                'color'     => $item->color,
                'price'     => $item->price,
                'name'      => $item->product->name,
                'image'     => optional($item->product->images->first())->image_path,
                'from'      => 'cart',
            ]);
        }
    }

    return view('user.checkout.checkout', compact('cartItems', 'shipping', 'tax'));
}


public function placeOrder(Request $request)
{
    try {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'required|string',
            'address'     => 'required|string',
            'city'        => 'required|string',
            'postal_code' => 'required|string',
            'country'     => 'nullable|string|max:255',
        ]);
        Log::info('✅ [Checkout] Validation passed', ['validated' => $validated]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('❌ [Validation Failed]', [
            'errors' => $e->errors(),
            'input'  => $request->all(),
        ]);
        throw $e; // let Laravel handle redirect after logging
    }
    

    DB::beginTransaction();

    try {
        // Get cart items
        if (Session::has('buy_now_item')) {
            $cartItems = collect([Session::get('buy_now_item')]);
            Log::info('🛍 Using Buy Now item', ['cartItems' => $cartItems]);
            Session::forget('buy_now_item');
        } else {
            if (Auth::check()) {
                $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
                Log::info('🧾 Fetched cart items for logged-in user', ['user_id' => Auth::id(), 'count' => $cartItems->count()]);
            } else {
                $guestToken = session('guest_token') ?? Cookie::get('guest_token');
                $cartItems = $guestToken
                    ? Cart::where('guest_token', $guestToken)->with('product')->get()
                    : collect();
                Log::info('🧾 Fetched cart items for guest', ['guest_token' => $guestToken, 'count' => $cartItems->count()]);
            }
        }

        if ($cartItems->isEmpty()) {
            Log::warning('⚠️ Cart is empty, aborting order placement.');
            return back()->with('error', 'Your cart is empty!');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($i) {
            $price = is_array($i) ? ($i['price'] ?? 0) : ($i->price ?? ($i->product->price ?? 0));
            $qty   = is_array($i) ? ($i['quantity'] ?? 1) : ($i->quantity ?? 1);
            return $price * $qty;
        });

        $shipping = 250;
        $tax = 0;

        $now = Carbon::now('Asia/Karachi');
        $activeSale = Sale::where('starts_at', '<=', $now)
            ->where('ends_at', '>=', $now)
            ->first();

        $discount = $activeSale ? ($subtotal * $activeSale->discount_percent) / 100 : 0;
        $total = $subtotal - $discount + $shipping + $tax;

        Log::info('💰 [Totals Calculated]', [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
            'active_sale' => $activeSale ? $activeSale->discount_percent : 'none'
        ]);

        // Create order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'guest_token'    => Auth::check() ? null : session('guest_token'),
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'tax'            => $tax,
            'discount'       => $discount,
            'total'          => $total,
            'payment_method' => 'cod',
            'status'         => 'pending',
        ]);

        Log::info('🧾 [Order Created]', ['order_id' => $order->id]);

        // Store order items
        foreach ($cartItems as $index => $item) {
            $productId = is_array($item) ? ($item['product_id'] ?? null) : ($item->product_id ?? ($item->product->id ?? null));
            $quantity  = is_array($item) ? ($item['quantity'] ?? 1) : ($item->quantity ?? 1);
            $price     = is_array($item) ? ($item['price'] ?? 0) : ($item->price ?? ($item->product->price ?? 0));
            $sizeId    = is_array($item) ? ($item['size_id'] ?? null) : ($item->size_id ?? null);
            $colorId   = is_array($item) ? ($item['color_id'] ?? null) : ($item->color_id ?? null);

            if (!$productId) {
                Log::error('❌ Missing product_id', ['item_index' => $index, 'item' => $item]);
                throw new \Exception("Missing product_id for item index {$index}");
            }

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'size_id'    => $sizeId,
                'color_id'   => $colorId,
                'quantity'   => $quantity,
                'price'      => $price,
                'total'      => $price * $quantity,
            ]);

            Log::info('🧩 [Order Item Created]', [
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        // Billing/shipping
        try {
            $isSameBilling = $request->boolean('same_billing', true);
            Log::info('📦 [Address Step Started]', ['isSameBilling' => $isSameBilling]);

            if ($isSameBilling) {
                $billing = OrderAddress::create([
                    'order_id'    => $order->id,
                    'type'        => 'billing',
                    'first_name'  => $validated['first_name'],
                    'last_name'   => $validated['last_name'],
                    'email'       => $validated['email'],
                    'phone'       => $validated['phone'],
                    'address'     => $validated['address'],
                    'city'        => $validated['city'],
                    'postal_code' => $validated['postal_code'],
                    'country'     => 'Pakistan',
                ]);
                Log::info('🏠 [Billing Address Created - Same as Shipping]', ['billing_id' => $billing->id]);
            } else {
                $billing = OrderAddress::create([
                    'order_id'    => $order->id,
                    'type'        => 'billing',
                    'first_name'  => $request->input('billing_first_name') ?? 'N/A',
                    'last_name'   => $request->input('billing_last_name') ?? 'N/A',
                    'email'       => $request->input('billing_email') ?? $validated['email'],
                    'phone'       => $request->input('billing_phone') ?? $validated['phone'],
                    'address'     => $request->input('billing_address') ?? $validated['address'],
                    'city'        => $request->input('billing_city') ?? $validated['city'],
                    'postal_code' => $request->input('billing_postal_code') ?? $validated['postal_code'],
                    'country'     => 'Pakistan',
                ]);
                Log::info('🏠 [Billing Address Created - Custom]', ['billing_id' => $billing->id]);
            }
        } catch (\Exception $e) {
            Log::error('❌ [Address Creation Failed]', ['error' => $e->getMessage()]);
            throw $e;
        }

        // Clear cart
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
            Log::info('🧹 [Cart Cleared for user]', ['user_id' => Auth::id()]);
        } else {
            $guestToken = session('guest_token') ?? Cookie::get('guest_token');
            Cart::where('guest_token', $guestToken)->delete();
            Log::info('🧹 [Cart Cleared for guest]', ['guest_token' => $guestToken]);
        }



        DB::commit();
        Log::info('✅ [Order Transaction Committed]', ['order_id' => $order->id]);

        $order->load('addresses'); 
        Mail::to($validated['email'])->send(new OrderPlacedMail($order));
        Mail::to('bilawal2407f@aptechgdn.net')->send(new AdminOrderAlertMail($order));

        return redirect()->route('order.confirmation', ['order' => $order->id]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('💥 [Order Placement Failed]', [
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'trace' => $e->getTraceAsString(),
        ]);
        return back()->with('error', 'Something went wrong! ' . $e->getMessage());
    }
}


public function confirmation($orderId)
{
    $order = Order::with([
        'items.product',
        'items.color',
        'items.size',
        'addresses'
    ])->findOrFail($orderId);
    
    return view('user.checkout.confirmation', compact('order'));
}

public function downloadInvoice($orderId)
{
    $order = Order::with([
        'items.product',
        'items.color',
        'items.size',
        'addresses'
    ])->findOrFail($orderId);
    
    $pdf = Pdf::loadView('user.checkout.invoice', compact('order'));
    return $pdf->download("invoice_{$order->id}.pdf");
}


}
