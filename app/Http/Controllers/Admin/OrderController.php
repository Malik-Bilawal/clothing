<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

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
        $oldStatus = $order->status;      // Store old status
        $order->status = $request->status;
        $order->save();

        // Log the status change
        Log::info('Order status updated', [
            'order_id'   => $order->id,
            'old_status' => $oldStatus,
            'new_status' => $order->status,
            'updated_by' => auth()->user() ? auth()->user()->id : null, // if using auth
            'timestamp'  => now()->toDateTimeString(),
        ]);
    }

    return redirect()->back()->with('success', 'Order status updated successfully!');
}

}
