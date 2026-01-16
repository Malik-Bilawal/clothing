<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's date for filtering
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Total Stats
        $stats = [
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'delievered')->sum('total'),
            'total_customers' => User::where('role', User::ROLE_USER)->count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'pending_messages' => ContactMessage::where('status', '!=', 'resolved')->count(),
            'active_sales' => Sale::where('is_active', true)
                ->where('starts_at', '<=', now())
                ->where('ends_at', '>=', now())
                ->count(),
        ];

        // Today's Stats
        $todayStats = [
            'today_orders' => Order::whereDate('created_at', $today)->count(),
            'today_revenue' => Order::whereDate('created_at', $today)
                ->where('status', 'delievered')
                ->sum('total'),
            'today_customers' => User::where('role', User::ROLE_USER)
                ->whereDate('created_at', $today)
                ->count(),
        ];

        // Monthly Stats
        $monthlyStats = [
            'month_orders' => Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'month_revenue' => Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 'delievered')
                ->sum('total'),
        ];

        // Recent Orders
        $recentOrders = Order::with(['user', 'items'])
            ->latest()
            ->take(10)
            ->get();

        // Recent Contact Messages
        $recentMessages = ContactMessage::latest()
            ->take(8)
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::whereHas('sizes', function ($query) {
            $query->where('stock', '<=', 10);
        })->with(['sizes' => function ($query) {
            $query->orderBy('stock', 'asc');
        }])->take(8)->get();
        


        // Top Selling Products
        $topProducts = Product::withSum('orderItems', 'quantity') // sums quantity from orderItems
            ->orderBy('order_items_sum_quantity', 'desc')        // order by the sum
            ->take(5)
            ->get();
        
        // Revenue Chart Data (Last 6 months)
        $revenueData = $this->getRevenueChartData();

        // Order Status Distribution
        $orderStatusData = $this->getOrderStatusData();

        return view('admin.dashboard', compact(
            'stats',
            'todayStats',
            'monthlyStats',
            'recentOrders',
            'recentMessages',
            'lowStockProducts',
            'topProducts',
            'revenueData',
            'orderStatusData'
        ));
    }

    private function getRevenueChartData()
    {
        $months = [];
        $revenues = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $revenue = Order::where('status', 'delievered')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total');
            
            $revenues[] = $revenue;
        }

        return [
            'months' => $months,
            'revenues' => $revenues
        ];
    }

    private function getOrderStatusData()
    {
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $data = [];
        
        foreach ($statuses as $status) {
            $data[$status] = Order::where('status', $status)->count();
        }

        return $data;
    }

    public function getChartData(Request $request)
    {
        $type = $request->input('type', 'revenue');
        
        if ($type === 'orders') {
            return $this->getOrdersChartData();
        }
        
        return response()->json($this->getRevenueChartData());
    }

    private function getOrdersChartData()
    {
        $months = [];
        $orders = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $orderCount = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            
            $orders[] = $orderCount;
        }

        return [
            'months' => $months,
            'orders' => $orders
        ];
    }
}