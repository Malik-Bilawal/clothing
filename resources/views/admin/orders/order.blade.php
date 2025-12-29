@extends('admin.layouts.master-layouts.plain')

<title>Order Management - Grocery Store Admin</title>

@push('script')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#10b981',
                    secondary: '#1f2937'
                }
            }
        }
    }
</script>
@endpush

@section('content')
<div class="flex h-screen overflow-hidden">

<aside class="w-64 bg-white shadow h-screen fixed top-0 left-0">
    @include("admin.layouts.partial.sidebar")
</aside>

<div class="ml-64 flex-1 overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">

    <!-- Top Bar -->
    <header class="bg-white shadow-sm z-10">
        <div class="flex justify-between items-center p-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Order Management</h2>
                <nav class="text-sm text-gray-500">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                            <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                        </li>
                        <li class="flex items-center">
                            <span class="text-gray-700">Order Management</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto p-6">

        <!-- Filter Section -->
        <section class="px-6 py-4 bg-white shadow-sm mt-1 mb-6">
            <form method="GET" action="" class="flex flex-wrap items-center gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Order Status</label>
                    <select name="status" class="border rounded-md px-3 py-2 text-sm w-40">
                        <option value="">All Status</option>
                        @foreach(['pending','processing','shipped','completed','cancelled'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                    <select name="sort" class="border rounded-md px-3 py-2 text-sm w-40">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                        <i class="fas fa-filter mr-2"></i> Apply Filters
                    </button>
                </div>

                <a href="{{ route('admin.orders.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm flex items-center">
                   Reset
                </a>
            </form>
        </section>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            @php $address = $order->addresses->first(); @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->id }}</td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-purple-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $address->first_name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $address->email ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($order->payment_method ?? 'cod') }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ ucfirst($order->status ?? 'Pending') }}</td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status == 'shipped' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status == 'completed' ? 'bg-gray-100 text-gray-800' : '' }}
                                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($order->status ?? 'Pending') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.order.ship', $order->id) }}" method="POST">
                                        @csrf
                                        <button class="text-green-600 hover:text-green-900" title="Ship">
                                            <i class="fas fa-shipping-fast"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.order.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button class="text-red-600 hover:text-red-900" title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
