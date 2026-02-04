<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

/**
 * CartService
 * 
 * Handles all shopping cart operations using session storage.
 * Supports guest checkout - no authentication required.
 */
class CartService
{
    /**
     * The session key for cart data.
     */
    protected const SESSION_KEY = 'cart';

    /**
     * Get all items in the cart.
     */
    public function getItems(): Collection
    {
        return collect(session(self::SESSION_KEY, []));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Product $product, int $quantity = 1): void
    {
        $cart = $this->getItems();
        $key = (string) $product->id;

        if ($cart->has($key)) {
            $item = $cart->get($key);
            $item['quantity'] += $quantity;
            $cart->put($key, $item);
        } else {
            $cart->put($key, [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->current_price,
                'original_price' => $product->price,
                'has_discount' => $product->has_discount,
                'quantity' => $quantity,
                'image' => $product->primary_image?->thumbnail_url,
            ]);
        }

        $this->save($cart);
    }

    /**
     * Update the quantity of an item in the cart.
     */
    public function update(int $productId, int $quantity): void
    {
        $cart = $this->getItems();
        $key = (string) $productId;

        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        if ($cart->has($key)) {
            $item = $cart->get($key);
            $item['quantity'] = $quantity;
            $cart->put($key, $item);
            $this->save($cart);
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(int $productId): void
    {
        $cart = $this->getItems();
        $cart->forget((string) $productId);
        $this->save($cart);
    }

    /**
     * Clear all items from the cart.
     */
    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Get the number of unique items in the cart.
     */
    public function count(): int
    {
        return $this->getItems()->count();
    }

    /**
     * Get the total number of items (sum of quantities).
     */
    public function totalQuantity(): int
    {
        return $this->getItems()->sum('quantity');
    }

    /**
     * Calculate the subtotal (before tax).
     */
    public function subtotal(): float
    {
        return $this->getItems()->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    /**
     * Calculate the tax amount.
     * Tax rate is configurable via environment variable.
     */
    public function tax(): float
    {
        $taxRate = (float) config('cafe.tax_rate', 0);
        return round($this->subtotal() * ($taxRate / 100), 2);
    }

    /**
     * Calculate the total (subtotal + tax).
     */
    public function total(): float
    {
        return round($this->subtotal() + $this->tax(), 2);
    }

    /**
     * Check if the cart is empty.
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * Validate cart items against current product data.
     * Updates prices and removes unavailable products.
     */
    public function validateAndSync(): array
    {
        $cart = $this->getItems();
        $messages = [];

        if ($cart->isEmpty()) {
            return $messages;
        }

        $productIds = $cart->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)
            ->active()
            ->with('images')
            ->get()
            ->keyBy('id');

        foreach ($cart as $key => $item) {
            $product = $products->get($item['product_id']);

            if (!$product) {
                $cart->forget($key);
                $messages[] = "{$item['name']} is no longer available and was removed from your cart.";
                continue;
            }

            // Check stock
            if ($product->stock !== null && $product->stock < $item['quantity']) {
                if ($product->stock <= 0) {
                    $cart->forget($key);
                    $messages[] = "{$product->name} is out of stock and was removed from your cart.";
                    continue;
                } else {
                    $item['quantity'] = $product->stock;
                    $messages[] = "{$product->name} quantity was reduced to {$product->stock} (max available).";
                }
            }

            // Update price if changed
            if ($item['price'] != $product->current_price) {
                $item['price'] = $product->current_price;
                $item['original_price'] = $product->price;
                $item['has_discount'] = $product->has_discount;
                $messages[] = "Price for {$product->name} has been updated.";
            }

            // Update image if changed
            $item['image'] = $product->primary_image?->thumbnail_url;
            $cart->put($key, $item);
        }

        $this->save($cart);
        return $messages;
    }

    /**
     * Save the cart to session.
     */
    protected function save(Collection $cart): void
    {
        session([self::SESSION_KEY => $cart->toArray()]);
    }

    /**
     * Get cart items with full product data for checkout.
     */
    public function getItemsWithProducts(): Collection
    {
        $cart = $this->getItems();

        if ($cart->isEmpty()) {
            return collect();
        }

        $productIds = $cart->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)
            ->with('images')
            ->get()
            ->keyBy('id');

        return $cart->map(function ($item) use ($products) {
            $item['product'] = $products->get($item['product_id']);
            return $item;
        });
    }
}
