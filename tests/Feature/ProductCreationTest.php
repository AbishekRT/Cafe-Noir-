<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'A test category',
            'is_active' => true,
        ]);
    }

    /**
     * Test admin can view product creation page.
     */
    public function test_admin_can_view_product_creation_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/products/create');

        $response->assertStatus(200);
        $response->assertSee('Add Product');
    }

    /**
     * Test admin can create a product.
     */
    public function test_admin_can_create_product(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Test Coffee Blend',
            'description' => 'A delicious test coffee blend with rich flavors.',
            'price' => 24.99,
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
            'sku' => 'TEST-001',
            'weight' => 250,
            'is_active' => true,
            'is_featured' => false,
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Test Coffee Blend',
            'price' => 24.99,
            'sku' => 'TEST-001',
        ]);
    }

    /**
     * Test admin can create product with images.
     */
    public function test_admin_can_create_product_with_images(): void
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('coffee.jpg', 1200, 800);

        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Coffee With Image',
            'description' => 'A test coffee with image.',
            'price' => 29.99,
            'stock_quantity' => 50,
            'category_id' => $this->category->id,
            'sku' => 'TEST-002',
            'is_active' => true,
            'images' => [$image],
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Coffee With Image',
        ]);
    }

    /**
     * Test product creation validation - name required.
     */
    public function test_product_creation_requires_name(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'description' => 'A test description',
            'price' => 24.99,
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test product creation validation - price required.
     */
    public function test_product_creation_requires_price(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Test Product',
            'description' => 'A test description',
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors(['price']);
    }

    /**
     * Test product creation validation - price must be numeric.
     */
    public function test_product_price_must_be_numeric(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Test Product',
            'description' => 'A test description',
            'price' => 'not-a-number',
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors(['price']);
    }

    /**
     * Test admin can update a product.
     */
    public function test_admin_can_update_product(): void
    {
        $product = Product::create([
            'name' => 'Original Product',
            'slug' => 'original-product',
            'description' => 'Original description',
            'price' => 19.99,
            'stock_quantity' => 50,
            'category_id' => $this->category->id,
            'sku' => 'ORIG-001',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 29.99,
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
            'sku' => 'UPDT-001',
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => 29.99,
        ]);
    }

    /**
     * Test admin can delete a product.
     */
    public function test_admin_can_delete_product(): void
    {
        $product = Product::create([
            'name' => 'Product to Delete',
            'slug' => 'product-to-delete',
            'description' => 'Will be deleted',
            'price' => 19.99,
            'stock_quantity' => 50,
            'category_id' => $this->category->id,
            'sku' => 'DEL-001',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/products/{$product->id}");

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test non-admin cannot create products.
     */
    public function test_non_admin_cannot_create_product(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->post('/admin/products', [
            'name' => 'Test Product',
            'description' => 'A test description',
            'price' => 24.99,
            'stock_quantity' => 100,
            'category_id' => $this->category->id,
        ]);

        $response->assertStatus(403);
    }
}
