<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

/**
 * HomeController
 * 
 * Handles the home page with featured products and brand information.
 */
class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Cache featured products for 60 seconds for performance
        // Query count: 2 (products + images via eager loading)
        $featuredProducts = Cache::remember('featured_products', config('cafe.shop.featured_cache_ttl', 60), function () {
            return Product::with(['images', 'category'])
                ->active()
                ->featured()
                ->inStock()
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        });

        // Get active categories for the category showcase
        $categories = Category::active()
            ->ordered()
            ->withCount([
                'products' => function ($query) {
                    $query->active();
                }
            ])
            ->take(4)
            ->get();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
