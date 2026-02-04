<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * ProductController
 * 
 * Handles CRUD operations for products in the admin panel.
 * Includes image upload with automatic resizing.
 */
class ProductController extends Controller
{
    /**
     * The image service instance.
     */
    protected ImageService $imageService;

    /**
     * Create a new controller instance.
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images'])
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::ordered()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string|max:5000',
            'price' => 'required|numeric|min:0.01|max:99999.99',
            'discount_price' => 'nullable|numeric|min:0.01|max:99999.99|lt:price',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'images' => 'required|array|min:2|max:4',
            'images.*' => ['required', 'image', ...ImageService::validationRules()],
        ], [
            'images.min' => 'Please upload at least 2 images.',
            'images.max' => 'You can upload a maximum of 4 images.',
            'discount_price.lt' => 'Discount price must be less than the regular price.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);

        // Create the product
        $product = Product::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $this->uploadImages($product, $request->file('images'));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'images']);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::active()->ordered()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'description' => 'required|string|max:5000',
            'price' => 'required|numeric|min:0.01|max:99999.99',
            'discount_price' => 'nullable|numeric|min:0.01|max:99999.99|lt:price',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'images' => 'nullable|array|max:4',
            'images.*' => ['image', ...ImageService::validationRules()],
        ], [
            'images.max' => 'You can upload a maximum of 4 images.',
            'discount_price.lt' => 'Discount price must be less than the regular price.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        // Update the product
        $product->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            // Check total images
            $currentCount = $product->images()->count();
            $newCount = count($request->file('images'));

            if ($currentCount + $newCount > 4) {
                return back()->with('error', 'Total images cannot exceed 4. Please delete some existing images first.');
            }

            $this->uploadImages($product, $request->file('images'), $currentCount > 0);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // Delete all associated images
        foreach ($product->images as $image) {
            $image->delete(); // This triggers the model's deleting event
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Delete a product image.
     */
    public function deleteImage(Product $product, ProductImage $image)
    {
        // Ensure the image belongs to the product
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        // Check minimum images
        if ($product->images()->count() <= 2) {
            return back()->with('error', 'Products must have at least 2 images.');
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Set a product image as primary.
     */
    public function setPrimaryImage(Product $product, ProductImage $image)
    {
        // Ensure the image belongs to the product
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        // Reset all images to non-primary
        $product->images()->update(['is_primary' => false]);

        // Set this image as primary
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image updated.');
    }

    /**
     * Upload and process product images.
     */
    protected function uploadImages(Product $product, array $files, bool $hasPrimary = false): void
    {
        foreach ($files as $index => $file) {
            try {
                $paths = $this->imageService->upload($file, 'products');

                ProductImage::create([
                    'product_id' => $product->id,
                    'original_path' => $paths['original'],
                    'large_path' => $paths['large'],
                    'medium_path' => $paths['medium'],
                    'thumbnail_path' => $paths['thumbnail'],
                    'alt_text' => $product->name,
                    'sort_order' => $index,
                    'is_primary' => !$hasPrimary && $index === 0,
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Image upload failed: ' . $e->getMessage());
            }
        }
    }
}
