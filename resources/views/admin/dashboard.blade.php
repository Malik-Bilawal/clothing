@extends('admin.layouts.master-layouts.plain')

@section('title', 'Dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .stat-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-shipped { background-color: #fce7f3; color: #9d174d; }
        .status-delivered { background-color: #dcfce7; color: #166534; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
    </style>
<div 
    x-data="{ sidebarOpen: false }" 
    @close-sidebar.window="sidebarOpen = false" 
    class="flex h-screen overflow-hidden"
>

    <button @click="sidebarOpen = true" 
        class="fixed top-4 left-4 z-40 p-2 bg-gray-900 text-white rounded-md lg:hidden">
        <i class="fas fa-bars"></i>
    </button>

    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>

    <div class="flex-1 flex p-5 flex-col overflow-y-auto lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-600">Welcome back, Admin! Here's what's happening with your store today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">



    <!-- Stats Grid -->
        <!-- Total Revenue -->
        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-800">Rs.{{ number_format($stats['total_revenue'], 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600">+${{ number_format($monthlyStats['month_revenue'], 2) }}</span> this month
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600">+{{ $todayStats['today_orders'] }}</span> today
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Customers</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_customers'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-green-600">+{{ $todayStats['today_customers'] }}</span> today
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1.205a21.962 21.962 0 01-3.14 5.687"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Products</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_products'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <span class="text-red-600">{{ $lowStockProducts->count() }}</span> low in stock
                    </p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Revenue Overview</h2>
                <div class="flex space-x-2">
                    <button onclick="switchChart('revenue')" class="px-3 py-1 text-sm rounded-lg bg-blue-100 text-blue-700 font-medium">Revenue</button>
                    <button onclick="switchChart('orders')" class="px-3 py-1 text-sm rounded-lg bg-gray-100 text-gray-700 font-medium">Orders</button>
                </div>
            </div>
            <div class="h-72">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Order Status Chart -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Order Status Distribution</h2>
            <div class="h-72">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Messages -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.order.show', $order->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                    #{{ $order->order_number }}
                                </a>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $order->user->name ?? 'Guest' }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-900">Rs.{{ number_format($order->total, 2) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t text-center">
                <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                    View All Orders →
                </a>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Recent Messages</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentMessages as $message)
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $message->first_name }} {{ $message->last_name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->message, 60) }}</p>
                        </div>
                        <span class="text-xs text-gray-500">{{ $message->created_at->format('M d') }}</span>
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">
                            {{ $message->subject }}
                        </span>
                        <a href="{{ route('admin.contact') }}" class="text-xs text-blue-600 hover:text-blue-800">
                            View →
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    No messages found
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Products & Low Stock -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Selling Products -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Top Selling Products</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($topProducts as $product)
                <div class="p-4 hover:bg-gray-50 flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-lg overflow-hidden">
                        <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="font-medium text-gray-900">{{ Str::limit($product->name, 30) }}</h4>
                        <div class="flex items-center mt-1">
                            <span class="text-sm text-gray-600">${{ number_format($product->final_price, 2) }}</span>
                            <span class="mx-2">•</span>
                            <span class="text-sm text-green-600">{{ $product->total_sold ?? 0 }} sold</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    No products found
                </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Low Stock Products</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($lowStockProducts as $product)
                <div class="p-4 hover:bg-gray-50 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">{{ Str::limit($product->name, 25) }}</h4>
                            <p class="text-sm text-gray-600">SKU: {{ $product->sku }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            {{ $product->stock }} left
                        </span>
                        <p class="text-xs text-gray-500 mt-1">Reorder needed</p>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    All products have sufficient stock
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize charts
    let revenueChart, orderStatusChart;
    let currentChartType = 'revenue';

    document.addEventListener('DOMContentLoaded', function() {
        initRevenueChart();
        initOrderStatusChart();
    });

    function initRevenueChart() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($revenueData['months']),
                datasets: [{
                    label: 'Revenue',
                    data: @json($revenueData['revenues']),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return `$${context.parsed.y.toFixed(2)}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    function initOrderStatusChart() {
        const ctx = document.getElementById('orderStatusChart').getContext('2d');
        const statusData = @json($orderStatusData);
        const statusColors = {
            pending: '#f59e0b',
            processing: '#3b82f6',
            shipped: '#ec4899',
            delivered: '#10b981',
            cancelled: '#ef4444'
        };

        orderStatusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(statusData).map(key => key.charAt(0).toUpperCase() + key.slice(1)),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: Object.keys(statusData).map(key => statusColors[key]),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }

    function switchChart(type) {
        if (currentChartType === type) return;
        
        currentChartType = type;
        
        // Update button styles
        document.querySelectorAll('#revenueChart').previousElementSibling.querySelectorAll('button').forEach(btn => {
            btn.classList.remove('bg-blue-100', 'text-blue-700');
            btn.classList.add('bg-gray-100', 'text-gray-700');
        });
        event.target.classList.remove('bg-gray-100', 'text-gray-700');
        event.target.classList.add('bg-blue-100', 'text-blue-700');

       // Fetch new data and update chart
fetch(`/admin/dashboard/chart-data?type=${type}`)
    .then(response => response.json())
    .then(data => {
        // Set dataset label
        const label = type === 'revenue' ? 'Revenue' : 'Orders';

        // Update chart data
        revenueChart.data.labels = data.months;
        revenueChart.data.datasets[0].data = type === 'revenue' ? data.revenues : data.orders;
        revenueChart.data.datasets[0].label = label;

        // Update tooltip
        revenueChart.options.plugins.tooltip.callbacks.label = function(context) {
            const value = context.parsed.y;
            return type === 'revenue'
                ? `$${value.toFixed(2)}`       // Revenue formatted with $ and 2 decimals
                : `${value} orders`;           // Orders formatted with text
        };

        // Update Y-axis tick formatting
        revenueChart.options.scales.y.ticks.callback = function(value) {
            return type === 'revenue'
                ? '$' + value.toLocaleString()
                : value.toLocaleString();
        };

        // Refresh chart
        revenueChart.update();
    })
    .catch(error => console.error('Error fetching chart data:', error));

    }

    // Auto-refresh data every 5 minutes
    setInterval(() => {
        fetch('/admin/dashboard/chart-data?type=' + currentChartType)
            .then(response => response.json())
            .then(data => {
                revenueChart.data.datasets[0].data = currentChartType === 'revenue' ? data.revenues : data.orders;
                revenueChart.update();
            });
    }, 300000);
</script>
@endsection