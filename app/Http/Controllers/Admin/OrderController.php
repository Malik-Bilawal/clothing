<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('addresses');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 
        if ($request->get('sort') === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); 
        }

        $orders = $query->get();

        return view('admin.orders.order', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::with(['items.product', 'addresses'])->findOrFail($orderId);
        return view('admin.orders.order-detail', compact('order'));
    }

    public function ship($orderId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->status !== 'shipped') {
            $order->status = 'shipped';
            $order->save();
        }

        return redirect()->back()->with('success', 'Order marked as shipped.');
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        $order->status = 'cancelled';
        $order->save();
    
        return redirect()->back()->with('success', 'Order cancelled successfully!');
    }
    

    public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    if ($request->has('status')) {
        $order->status = $request->status;
        $order->save();
    }

    return redirect()->back()->with('success', 'Order status updated successfully!');
}

}
