<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;

/**
 * DashboardController
 * 
 * Handles the admin dashboard with key metrics and recent activity.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get dashboard statistics
        $stats = [
            'totalProducts' => Product::count(),
            'activeProducts' => Product::active()->count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::withStatus(Order::STATUS_PENDING)->count(),
            'unreadContacts' => Contact::unread()->count(),
            'totalCategories' => Category::count(),
            'totalCustomers' => User::where('is_admin', false)->count(),
            'totalRevenue' => Order::where('payment_status', Order::PAYMENT_PAID)->sum('total'),
            'monthlyRevenue' => Order::where('payment_status', Order::PAYMENT_PAID)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total'),
        ];

        // Get recent orders (eager loading for performance)
        $recentOrders = Order::with('items')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Get recent contacts
        $recentContacts = Contact::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get low stock products
        $lowStockProducts = Product::whereNotNull('stock_quantity')
            ->where('stock_quantity', '<=', 5)
            ->where('stock_quantity', '>', 0)
            ->orderBy('stock_quantity', 'asc')
            ->take(5)
            ->get();

        // Get out of stock products
        $outOfStockProducts = Product::where('stock_quantity', 0)->count();

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'recentContacts',
            'lowStockProducts',
            'outOfStockProducts'
        ));
    }
}
