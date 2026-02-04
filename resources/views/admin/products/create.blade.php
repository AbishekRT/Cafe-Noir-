{{-- 
    Admin Create Product
    Features: Product form with image upload, variants
--}}
<x-app-layout>
    <x-slot name="title">Add Product - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <nav class="text-secondary/60 text-sm mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-secondary">Products</a>
                    <span class="mx-2">/</span>
                    <span class="text-secondary">Add Product</span>
                </nav>
                <h1 class="text-2xl font-heading font-bold text-secondary">Add New Product</h1>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Basic Info -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-6">Basic Information</h2>
                            
                            <div class="space-y-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-heading mb-2">
                                        Product Name <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('name') border-red-500 @enderror"
                                        placeholder="Enter product name"
                                    >
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Slug -->
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-heading mb-2">
                                        URL Slug
                                    </label>
                                    <input 
                                        type="text" 
                                        id="slug" 
                                        name="slug" 
                                        value="{{ old('slug') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('slug') border-red-500 @enderror"
                                        placeholder="auto-generated-from-name"
                                    >
                                    <p class="mt-1 text-xs text-muted">Leave empty to auto-generate from name</p>
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Short Description -->
                                <div>
                                    <label for="short_description" class="block text-sm font-medium text-heading mb-2">
                                        Short Description
                                    </label>
                                    <textarea 
                                        id="short_description" 
                                        name="short_description" 
                                        rows="2"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent resize-none @error('short_description') border-red-500 @enderror"
                                        placeholder="Brief product description for listings"
                                    >{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Full Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-heading mb-2">
                                        Full Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea 
                                        id="description" 
                                        name="description" 
                                        rows="6"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent resize-none @error('description') border-red-500 @enderror"
                                        placeholder="Detailed product description"
                                    >{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-6">Pricing</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-heading mb-2">
                                        Price <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">$</span>
                                        <input 
                                            type="number" 
                                            id="price" 
                                            name="price" 
                                            value="{{ old('price') }}"
                                            step="0.01"
                                            min="0"
                                            required
                                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('price') border-red-500 @enderror"
                                            placeholder="0.00"
                                        >
                                    </div>
                                    @error('price')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Compare Price -->
                                <div>
                                    <label for="compare_price" class="block text-sm font-medium text-heading mb-2">
                                        Compare at Price
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">$</span>
                                        <input 
                                            type="number" 
                                            id="compare_price" 
                                            name="compare_price" 
                                            value="{{ old('compare_price') }}"
                                            step="0.01"
                                            min="0"
                                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('compare_price') border-red-500 @enderror"
                                            placeholder="0.00"
                                        >
                                    </div>
                                    <p class="mt-1 text-xs text-muted">Original price for showing discounts</p>
                                    @error('compare_price')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Cost -->
                                <div>
                                    <label for="cost_price" class="block text-sm font-medium text-heading mb-2">
                                        Cost per Item
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">$</span>
                                        <input 
                                            type="number" 
                                            id="cost_price" 
                                            name="cost_price" 
                                            value="{{ old('cost_price') }}"
                                            step="0.01"
                                            min="0"
                                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('cost_price') border-red-500 @enderror"
                                            placeholder="0.00"
                                        >
                                    </div>
                                    <p class="mt-1 text-xs text-muted">For profit calculations (not shown to customers)</p>
                                    @error('cost_price')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-6">Inventory</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- SKU -->
                                <div>
                                    <label for="sku" class="block text-sm font-medium text-heading mb-2">
                                        SKU (Stock Keeping Unit)
                                    </label>
                                    <input 
                                        type="text" 
                                        id="sku" 
                                        name="sku" 
                                        value="{{ old('sku') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('sku') border-red-500 @enderror"
                                        placeholder="ABC-12345"
                                    >
                                    @error('sku')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Stock Quantity -->
                                <div>
                                    <label for="stock_quantity" class="block text-sm font-medium text-heading mb-2">
                                        Stock Quantity <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="stock_quantity" 
                                        name="stock_quantity" 
                                        value="{{ old('stock_quantity', 0) }}"
                                        min="0"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('stock_quantity') border-red-500 @enderror"
                                    >
                                    @error('stock_quantity')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-6">Product Images</h2>
                            
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-accent transition-colors">
                                <input 
                                    type="file" 
                                    id="images" 
                                    name="images[]" 
                                    multiple 
                                    accept="image/*"
                                    class="hidden"
                                >
                                <label for="images" class="cursor-pointer">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-heading font-medium">Click to upload images</p>
                                    <p class="text-sm text-muted mt-1">PNG, JPG, GIF up to 5MB each</p>
                                </label>
                            </div>
                            <p class="mt-2 text-xs text-muted">First image will be set as the primary image</p>
                            @error('images')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SEO -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-6">SEO Settings</h2>
                            
                            <div class="space-y-6">
                                <!-- SEO Title -->
                                <div>
                                    <label for="seo_title" class="block text-sm font-medium text-heading mb-2">
                                        SEO Title
                                    </label>
                                    <input 
                                        type="text" 
                                        id="seo_title" 
                                        name="seo_title" 
                                        value="{{ old('seo_title') }}"
                                        maxlength="60"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('seo_title') border-red-500 @enderror"
                                        placeholder="Page title for search engines"
                                    >
                                    <p class="mt-1 text-xs text-muted">Recommended: 50-60 characters</p>
                                    @error('seo_title')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- SEO Description -->
                                <div>
                                    <label for="seo_description" class="block text-sm font-medium text-heading mb-2">
                                        SEO Description
                                    </label>
                                    <textarea 
                                        id="seo_description" 
                                        name="seo_description" 
                                        rows="3"
                                        maxlength="160"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent resize-none @error('seo_description') border-red-500 @enderror"
                                        placeholder="Meta description for search engines"
                                    >{{ old('seo_description') }}</textarea>
                                    <p class="mt-1 text-xs text-muted">Recommended: 150-160 characters</p>
                                    @error('seo_description')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Status -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-4">Status</h2>
                            
                            <div class="space-y-4">
                                <label class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="is_active" 
                                        value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                        class="w-4 h-4 text-accent border-gray-300 rounded focus:ring-accent"
                                    >
                                    <span class="ml-2 text-sm text-heading">Active (visible in store)</span>
                                </label>
                                
                                <label class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="is_featured" 
                                        value="1"
                                        {{ old('is_featured') ? 'checked' : '' }}
                                        class="w-4 h-4 text-accent border-gray-300 rounded focus:ring-accent"
                                    >
                                    <span class="ml-2 text-sm text-heading">Featured product</span>
                                </label>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-4">Category</h2>
                            
                            <select 
                                name="category_id" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent @error('category_id') border-red-500 @enderror"
                            >
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            
                            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center mt-3 text-sm text-accent hover:text-accent/80">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add new category
                            </a>
                        </div>

                        <!-- Product Details -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-heading font-semibold text-heading mb-4">Product Details</h2>
                            
                            <div class="space-y-4">
                                <!-- Weight -->
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-heading mb-2">
                                        Weight
                                    </label>
                                    <input 
                                        type="text" 
                                        id="weight" 
                                        name="weight" 
                                        value="{{ old('weight') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                        placeholder="e.g., 250g, 1kg"
                                    >
                                </div>
                                
                                <!-- Roast Level -->
                                <div>
                                    <label for="roast_level" class="block text-sm font-medium text-heading mb-2">
                                        Roast Level
                                    </label>
                                    <select 
                                        id="roast_level" 
                                        name="roast_level" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                    >
                                        <option value="">Select roast level</option>
                                        <option value="light" {{ old('roast_level') == 'light' ? 'selected' : '' }}>Light</option>
                                        <option value="medium-light" {{ old('roast_level') == 'medium-light' ? 'selected' : '' }}>Medium-Light</option>
                                        <option value="medium" {{ old('roast_level') == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="medium-dark" {{ old('roast_level') == 'medium-dark' ? 'selected' : '' }}>Medium-Dark</option>
                                        <option value="dark" {{ old('roast_level') == 'dark' ? 'selected' : '' }}>Dark</option>
                                    </select>
                                </div>
                                
                                <!-- Origin -->
                                <div>
                                    <label for="origin" class="block text-sm font-medium text-heading mb-2">
                                        Origin
                                    </label>
                                    <input 
                                        type="text" 
                                        id="origin" 
                                        name="origin" 
                                        value="{{ old('origin') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent"
                                        placeholder="e.g., Ethiopia, Colombia"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="space-y-3">
                                <button type="submit" class="w-full px-4 py-3 bg-accent text-primary font-medium rounded-lg hover:bg-accent/90 transition-colors">
                                    Create Product
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="block w-full px-4 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors text-center">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
