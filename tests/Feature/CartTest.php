<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected Category $category;
    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'A test category',
            'is_active' => true,
        ]);

        $this->product = Product::create([
            'name' => 'Test Coffee',
            'slug' => 'test-coffee',
            'description' => 'A delicious test coffee',
            'price' => 24.99,
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
            'sku' => 'TEST-001',
            'is_active' => true,
        ]);
    }

    /**
     * Test that cart page is accessible.
     */
    public function test_cart_page_is_accessible(): void
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
    }

    /**
     * Test adding item to cart.
     */
    public function test_can_add_item_to_cart(): void
    {
        $response = $this->post('/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Check that the session has cart data
        $this->assertNotEmpty(session('cart'));
    }

    /**
     * Test adding item with invalid product ID.
     */
    public function test_cannot_add_nonexistent_product_to_cart(): void
    {
        $response = $this->post('/cart/add', [
            'product_id' => 99999,
            'quantity' => 1,
        ]);

        $response->assertSessionHasErrors(['product_id']);
    }

    /**
     * Test adding item with zero quantity.
     */
    public function test_cannot_add_zero_quantity_to_cart(): void
    {
        $response = $this->post('/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 0,
        ]);

        $response->assertSessionHasErrors(['quantity']);
    }

    /**
     * Test updating cart item quantity.
     */
    public function test_can_update_cart_item_quantity(): void
    {
        // First add item to cart
        $this->post('/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        // Then update quantity
        $response = $this->patch('/cart/update', [
            'product_id' => $this->product->id,
            'quantity' => 5,
        ]);

        $response->assertRedirect();

        // Check cart has updated quantity
        $cart = session('cart');
        $this->assertEquals(5, $cart[$this->product->id]['quantity']);
    }

    /**
     * Test removing item from cart.
     */
    public function test_can_remove_item_from_cart(): void
    {
        // First add item to cart
        $this->post('/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        // Then remove it
        $response = $this->delete('/cart/remove/' . $this->product->id);

        $response->assertRedirect();

        // Check cart is empty or doesn't have the product
        $cart = session('cart', []);
        $this->assertArrayNotHasKey($this->product->id, $cart);
    }

    /**
     * Test clearing the cart.
     */
    public function test_can_clear_cart(): void
    {
        // First add item to cart
        $this->post('/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        // Then clear cart
        $response = $this->delete('/cart/clear');

        $response->assertRedirect();

        // Check cart is empty
        $cart = session('cart', []);
        $this->assertEmpty($cart);
    }

    /**
     * Test cart count in session.
     */
    public function test_cart_count_updates_correctly(): void
    {
        // Add first item
        $this->post('/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        // Create another product
        $product2 = Product::create([
            'name' => 'Another Coffee',
            'slug' => 'another-coffee',
            'description' => 'Another delicious coffee',
            'price' => 19.99,
            'stock_quantity' => 50,
            'category_id' => $this->category->id,
            'sku' => 'TEST-002',
            'is_active' => true,
        ]);

        // Add second item
        $this->post('/cart/add', [
            'product_id' => $product2->id,
            'quantity' => 3,
        ]);

        // Check cart count
        $cart = session('cart', []);
        $totalQuantity = collect($cart)->sum('quantity');
        $this->assertEquals(5, $totalQuantity);
    }

    /**
     * Test adding inactive product to cart fails.
     */
    public function test_cannot_add_inactive_product_to_cart(): void
    {
        $inactiveProduct = Product::create([
            'name' => 'Inactive Coffee',
            'slug' => 'inactive-coffee',
            'description' => 'An inactive coffee',
            'price' => 24.99,
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
            'sku' => 'INACTIVE-001',
            'is_active' => false,
        ]);

        $response = $this->post('/cart/add', [
            'product_id' => $inactiveProduct->id,
            'quantity' => 1,
        ]);

        // The validation should reject inactive products
        $response->assertSessionHasErrors(['product_id']);
    }

    /**
     * Test cannot add more than available stock.
     */
    public function test_cannot_exceed_stock_quantity(): void
    {
        $limitedProduct = Product::create([
            'name' => 'Limited Coffee',
            'slug' => 'limited-coffee',
            'description' => 'A limited stock coffee',
            'price' => 24.99,
            'stock_quantity' => 5,
            'category_id' => $this->category->id,
            'sku' => 'LIMITED-001',
            'is_active' => true,
        ]);

        $response = $this->post('/cart/add', [
            'product_id' => $limitedProduct->id,
            'quantity' => 10, // More than available
        ]);

        // Should either fail validation or limit to stock
        $response->assertSessionHasErrors();
    }
}
