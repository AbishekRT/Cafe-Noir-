<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * ProductApiController
 * 
 * Handles API requests for products.
 * Token-protected via Laravel Sanctum (optional).
 */
class ProductApiController extends Controller
{
    /**
     * Display a listing of products.
     * 
     * @queryParam category string Filter by category slug
     * @queryParam search string Search term
     * @queryParam sort string Sort by: newest, price_asc, price_desc
     * @queryParam per_page int Items per page (default: 12, max: 50)
     */
    public function index(Request $request)
    {
        $query = Product::with(['images', 'category'])
            ->active()
            ->inStock();

        // Apply category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Apply search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Apply sorting
        $sortOptions = [
            'newest' => ['created_at', 'desc'],
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
        ];

        $sort = $request->get('sort', 'newest');
        if (isset($sortOptions[$sort])) {
            $query->orderBy($sortOptions[$sort][0], $sortOptions[$sort][1]);
        }

        // Pagination
        $perPage = min((int) $request->get('per_page', 12), 50);
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
        ]);
    }

    /**
     * Display the specified product.
     * 
     * @urlParam slug string required Product slug
     */
    public function show(string $slug)
    {
        $product = Product::with(['images', 'category'])
            ->where('slug', $slug)
            ->active()
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }
}
