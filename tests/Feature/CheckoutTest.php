<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
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
     * Helper method to add item to cart.
     */
    protected function addToCart(): void
    {
        session([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ]);
    }

    /**
     * Test checkout page requires items in cart.
     */
    public function test_checkout_requires_items_in_cart(): void
    {
        $response = $this->get('/checkout');

        $response->assertRedirect('/cart');
    }

    /**
     * Test checkout page is accessible with items in cart.
     */
    public function test_checkout_page_is_accessible_with_cart_items(): void
    {
        $this->addToCart();

        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->get('/checkout');

        $response->assertStatus(200);
    }

    /**
     * Test COD checkout process.
     */
    public function test_can_complete_cod_checkout(): void
    {
        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_email' => 'john@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        // Check order was created
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
        ]);

        // Check order items were created
        $order = Order::where('customer_email', 'john@example.com')->first();
        $this->assertNotNull($order);
        $this->assertEquals(2, $order->items->first()->quantity);

        // Check redirected to success page
        $response->assertRedirect(route('checkout.success', $order->order_number));

        // Check cart was cleared
        $this->assertEmpty(session('cart'));
    }

    /**
     * Test checkout validation - name required.
     */
    public function test_checkout_requires_customer_name(): void
    {
        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_email' => 'john@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $response->assertSessionHasErrors(['customer_name']);
    }

    /**
     * Test checkout validation - email required.
     */
    public function test_checkout_requires_customer_email(): void
    {
        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $response->assertSessionHasErrors(['customer_email']);
    }

    /**
     * Test checkout validation - valid email format.
     */
    public function test_checkout_requires_valid_email(): void
    {
        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_email' => 'not-an-email',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $response->assertSessionHasErrors(['customer_email']);
    }

    /**
     * Test checkout validation - payment method required.
     */
    public function test_checkout_requires_payment_method(): void
    {
        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_email' => 'john@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                ]);

        $response->assertSessionHasErrors(['payment_method']);
    }

    /**
     * Test checkout reduces stock quantity.
     */
    public function test_checkout_reduces_product_stock(): void
    {
        $initialStock = $this->product->stock_quantity;

        $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_email' => 'john@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $this->product->refresh();
        $this->assertEquals($initialStock - 2, $this->product->stock_quantity);
    }

    /**
     * Test order number is generated.
     */
    public function test_order_number_is_generated(): void
    {
        $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 1,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_email' => 'john@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $order = Order::where('customer_email', 'john@example.com')->first();
        $this->assertNotNull($order->order_number);
        $this->assertNotEmpty($order->order_number);
    }

    /**
     * Test order total is calculated correctly.
     */
    public function test_order_total_is_calculated_correctly(): void
    {
        $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 2,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'John Doe',
                    'customer_email' => 'john@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Test Street',
                    'shipping_city' => 'Test City',
                    'shipping_state' => 'Test State',
                    'shipping_zip' => '12345',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $order = Order::where('customer_email', 'john@example.com')->first();
        $expectedSubtotal = $this->product->price * 2;

        $this->assertEquals($expectedSubtotal, $order->subtotal);
    }

    /**
     * Test guest can checkout without account.
     */
    public function test_guest_can_checkout(): void
    {
        $this->assertGuest();

        $response = $this->withSession([
            'cart' => [
                $this->product->id => [
                    'product_id' => $this->product->id,
                    'name' => $this->product->name,
                    'price' => $this->product->price,
                    'quantity' => 1,
                ]
            ]
        ])->post('/checkout', [
                    'customer_name' => 'Guest User',
                    'customer_email' => 'guest@example.com',
                    'customer_phone' => '+1234567890',
                    'shipping_address' => '123 Guest Street',
                    'shipping_city' => 'Guest City',
                    'shipping_state' => 'Guest State',
                    'shipping_zip' => '54321',
                    'shipping_country' => 'Pakistan',
                    'payment_method' => 'cod',
                ]);

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Guest User',
            'customer_email' => 'guest@example.com',
        ]);
    }
}
