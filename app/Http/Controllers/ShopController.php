<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * ShopController
 * 
 * Handles the shop listing and product detail pages.
 * Implements server-side pagination, filtering, and search.
 */
class ShopController extends Controller
{
    /**
     * Display the shop listing page.
     * 
     * Features:
     * - Server-side pagination (12 products per page)
     * - Category filtering
     * - Search by name and description
     * - Sort by price (asc/desc) or newest
     * - Eager loading for performance
     */
    public function index(Request $request)
    {
        // Query count: 3 (categories, products, images via eager loading)
        $categories = Category::active()->ordered()->get();

        $query = Product::with(['images', 'category'])
            ->active()
            ->inStock();

        // Apply category filter
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
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
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginate results (12 per page as specified)
        $products = $query->paginate(config('cafe.shop.products_per_page', 12))
            ->withQueryString();

        $selectedCategory = $request->category;
        $searchTerm = $request->search;

        return view('shop.index', compact(
            'products',
            'categories',
            'selectedCategory',
            'searchTerm',
            'sort'
        ));
    }

    /**
     * Display a single product detail page.
     * 
     * Features:
     * - Product information with images
     * - Price with discount display
     * - Stock availability
     * - SEO meta tags
     * - Related products from same category
     */
    public function show(Product $product)
    {
        // Abort if product is not active
        if (!$product->is_active) {
            abort(404);
        }

        // Load images for the product (lazy-loaded in gallery)
        $product->load('images', 'category');

        // Get related products from the same category
        // Query count: 1 (related products with images)
        $relatedProducts = Product::with(['images'])
            ->active()
            ->inStock()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
