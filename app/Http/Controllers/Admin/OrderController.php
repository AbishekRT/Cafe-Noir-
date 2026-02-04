<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * OrderController
 * 
 * Handles order management in the admin panel.
 * Includes order viewing, status updates, and history tracking.
 */
class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        // Query count: 1 (orders with items count)
        $query = Order::withCount('items')
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->withStatus($request->status);
        }

        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by order number or customer
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();
        $statuses = Order::getStatuses();
        $paymentMethods = Order::getPaymentMethods();

        return view('admin.orders.index', compact('orders', 'statuses', 'paymentMethods'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Eager load relationships
        // Query count: 1 (order with items, products, images, status history)
        $order->load([
            'items.product.images',
            'statusHistory.user',
            'user',
        ]);

        $statuses = Order::getStatuses();

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::getStatuses())),
            'notes' => 'nullable|string|max:500',
        ]);

        // Don't update if status is the same
        if ($order->status === $validated['status']) {
            return back()->with('info', 'Order status is already ' . Order::getStatuses()[$validated['status']] . '.');
        }

        $order->updateStatus(
            $validated['status'],
            auth()->id(),
            $validated['notes']
        );

        return back()->with('success', 'Order status updated to ' . Order::getStatuses()[$validated['status']] . '.');
    }

    /**
     * Display order statistics.
     */
    public function statistics()
    {
        // Get orders by status
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Get orders by payment method
        $ordersByPayment = Order::selectRaw('payment_method, COUNT(*) as count')
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method');

        // Get monthly revenue for the current year
        $monthlyRevenue = Order::where('payment_status', Order::PAYMENT_PAID)
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month');

        return view('admin.orders.statistics', compact(
            'ordersByStatus',
            'ordersByPayment',
            'monthlyRevenue'
        ));
    }
}
