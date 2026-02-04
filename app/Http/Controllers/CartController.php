<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

/**
 * CartController
 * 
 * Handles shopping cart operations.
 * Uses session-based storage for guest checkout support.
 */
class CartController extends Controller
{
    /**
     * The cart service instance.
     */
    protected CartService $cartService;

    /**
     * Create a new controller instance.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the cart page.
     */
    public function index()
    {
        // Validate and sync cart items with current product data
        $messages = $this->cartService->validateAndSync();
        $items = $this->cartService->getItems();

        return view('cart.index', [
            'items' => $items,
            'subtotal' => $this->cartService->subtotal(),
            'tax' => $this->cartService->tax(),
            'total' => $this->cartService->total(),
            'messages' => $messages,
            'taxRate' => config('cafe.tax_rate', 0),
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1|max:99',
        ]);

        $product = Product::with('images')->findOrFail($request->product_id);

        // Check if product is active
        if (!$product->is_active) {
            return back()->with('error', 'This product is not available.');
        }

        // Check stock
        if (!$product->is_in_stock) {
            return back()->with('error', 'This product is out of stock.');
        }

        $quantity = $request->input('quantity', 1);

        // Check if requested quantity is available
        if ($product->stock !== null && $product->stock < $quantity) {
            return back()->with('error', "Only {$product->stock} items available in stock.");
        }

        $this->cartService->add($product, $quantity);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} added to cart.",
                'cartCount' => $this->cartService->totalQuantity(),
            ]);
        }

        return back()->with('success', "{$product->name} has been added to your cart.");
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $product = Product::find($request->product_id);

        // Check stock if product exists
        if ($product && $product->stock !== null && $request->quantity > $product->stock) {
            return back()->with('error', "Only {$product->stock} items available in stock.");
        }

        $this->cartService->update($request->product_id, $request->quantity);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated.',
                'cartCount' => $this->cartService->totalQuantity(),
                'subtotal' => $this->cartService->subtotal(),
                'tax' => $this->cartService->tax(),
                'total' => $this->cartService->total(),
            ]);
        }

        return back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $this->cartService->remove($request->product_id);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'cartCount' => $this->cartService->totalQuantity(),
            ]);
        }

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')
            ->with('success', 'Your cart has been cleared.');
    }

    /**
     * Get cart data for AJAX requests.
     */
    public function data()
    {
        return response()->json([
            'count' => $this->cartService->totalQuantity(),
            'items' => $this->cartService->getItems(),
            'subtotal' => $this->cartService->subtotal(),
            'tax' => $this->cartService->tax(),
            'total' => $this->cartService->total(),
        ]);
    }
}
