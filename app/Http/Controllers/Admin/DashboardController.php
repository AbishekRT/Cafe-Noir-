<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Contact;

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
        // Get dashboard metrics
        $totalProducts = Product::count();
        $activeProducts = Product::active()->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::withStatus(Order::STATUS_PENDING)->count();
        $unreadContacts = Contact::unread()->count();

        // Calculate revenue
        $totalRevenue = Order::where('payment_status', Order::PAYMENT_PAID)
            ->sum('total');

        $monthlyRevenue = Order::where('payment_status', Order::PAYMENT_PAID)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Get recent orders (eager loading for performance)
        // Query count: 1
        $recentOrders = Order::with('items')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Get recent contacts
        $recentContacts = Contact::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get low stock products
        $lowStockProducts = Product::whereNotNull('stock')
            ->where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Get out of stock products
        $outOfStockProducts = Product::where('stock', 0)->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalOrders',
            'pendingOrders',
            'unreadContacts',
            'totalRevenue',
            'monthlyRevenue',
            'recentOrders',
            'recentContacts',
            'lowStockProducts',
            'outOfStockProducts'
        ));
    }
}
