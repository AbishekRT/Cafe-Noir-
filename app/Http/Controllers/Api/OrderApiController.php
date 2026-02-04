<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * OrderApiController
 * 
 * Handles API requests for orders.
 * Token-protected via Laravel Sanctum.
 */
class OrderApiController extends Controller
{
    /**
     * Display a listing of orders.
     * Requires authentication with admin privileges.
     * 
     * @queryParam status string Filter by status
     * @queryParam per_page int Items per page (default: 15, max: 50)
     */
    public function index(Request $request)
    {
        // Check if user is admin
        if (!$request->user() || !$request->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Admin access required.',
            ], 403);
        }

        $query = Order::with(['items'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->withStatus($request->status);
        }

        // Pagination
        $perPage = min((int) $request->get('per_page', 15), 50);
        $orders = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $orders->items(),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    /**
     * Display the specified order.
     * Requires authentication with admin privileges.
     * 
     * @urlParam id int required Order ID
     */
    public function show(Request $request, Order $order)
    {
        // Check if user is admin
        if (!$request->user() || !$request->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Admin access required.',
            ], 403);
        }

        $order->load(['items.product', 'statusHistory.user']);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }
}
