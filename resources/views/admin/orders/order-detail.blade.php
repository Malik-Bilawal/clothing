@extends("admin.layouts.master-layouts.plain")

@section("title", "Order Detail | Admin Panel")

@section("content")
<div 
    x-data="{ sidebarOpen: false }" 
    @close-sidebar.window="sidebarOpen = false" 
    class="flex h-screen overflow-hidden"
>

    <!-- Mobile backdrop -->
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>


    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>


    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-8 fade-in">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">Order Details</h1>
                    <p class="text-gray-500 mt-2">
                        Order code: 
                        <span class="font-mono bg-blue-50 text-blue-600 px-2 py-1 rounded-md">
                            {{ $order->id ? "ORD-".str_pad($order->id,6,"0",STR_PAD_LEFT) : 'N/A' }}
                        </span>
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-white text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 flex items-center shadow-sm">
                        Back to Orders
                    </a>
                </div>
            </div>

            {{-- Status Bar --}}
            <div class="bg-white rounded-xl shadow-sm p-5 mb-6 fade-in flex justify-between items-center">
                <div class="flex items-center">
                    <span class="text-lg font-medium text-gray-700 mr-3">Order Status:</span>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'completed') bg-green-100 text-green-800
                        @elseif($order->status == 'canceled') bg-red-100 text-red-800
                        @endif
                    ">
                        {{ ucfirst($order->status ?? 'N/A') }}
                    </span>
                </div>

                <div class="flex space-x-2">
                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="status"
        onchange="this.form.submit()"
        class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-sm hover:bg-blue-100 transition-colors cursor-pointer">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>
</form>

                    <form action="{{ route('admin.order.cancel', $order->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <button type="submit" onclick="confirm('Are u sure u  want to cecenl this order')" class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-sm hover:bg-red-100 transition-colors">
        Cancel Order
    </button>
</form>

                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                {{-- Left Column --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Customer Info --}}
                    @if($order->addresses && $order->addresses->count())
                        @php $address = $order->addresses->first(); @endphp
                        <div class="bg-white rounded-xl shadow-sm p-6 hover-lift">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Customer Information</h2>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-gray-600">Name</p>
                                    <p class="font-medium">{{ trim($address->first_name.' '.$address->last_name) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Email / Phone</p>
                                    <p class="font-medium">{{ $address->email ?? '-' }}</p>
                                    <p class="font-medium">{{ $address->phone ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Address</p>
                                    <p class="font-medium">{{ $address->address }}, {{ $address->city }}, {{ $address->postal_code }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Order Items --}}
                    @if($order->items && $order->items->count())
                        <div class="bg-white rounded-xl shadow-sm p-6 hover-lift">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Order Items ({{ $order->items->count() }})</h2>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left table-auto">
                                    <thead class="bg-gray-50 text-gray-600 text-sm">
                                        <tr>
                                            <th class="p-3 font-medium">Product</th>
                                            <th class="p-3 font-medium">Size</th>
                                            <th class="p-3 font-medium">Color</th>
                                            <th class="p-3 font-medium">Price</th>
                                            <th class="p-3 font-medium">Qty</th>
                                            <th class="p-3 font-medium">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($order->items as $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3">{{ $item->product->name ?? 'N/A' }}</td>
                                            <td class="p-3">{{ $item->size?->name ?? '-' }}</td>
                                            <td class="p-3">{{ $item->color?->name ?? '-' }}</td>
                                            <td class="p-3">Rs {{ number_format($item->price, 2) }}</td>
                                            <td class="p-3">{{ $item->quantity }}</td>
                                            <td class="p-3">Rs {{ number_format($item->total, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right Column --}}
                <div class="space-y-6">

                    {{-- Payment & Shipping --}}
                    <div class="bg-white rounded-xl shadow-sm p-6 hover-lift">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Payment & Shipping</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-600 text-sm">Payment Method</p>
                                <p class="font-medium">{{ ucfirst($order->payment_method) ?? 'COD' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Shipping</p>
                                <p class="font-medium">Rs {{ number_format($order->shipping, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift sticky top-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Order Summary</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Subtotal</span>
                                <span class="font-semibold">Rs {{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Discount</span>
                                <span class="font-semibold">- Rs {{ number_format($order->discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Shipping</span>
                                <span class="font-semibold">Rs {{ number_format($order->shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-lg font-bold border-t pt-2">
                                <span>Grand Total</span>
                                <span>Rs {{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
