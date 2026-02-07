{{--
Product Detail Page
Features: Image gallery, Product info, Add to cart, Related products
--}}
<x-app-layout>
    <x-slot name="title">{{ $product->seo_title }}</x-slot>
    <x-slot name="metaDescription">{{ $product->seo_description }}</x-slot>

    <!-- Breadcrumb -->
    <nav class="py-4"
        style="background: linear-gradient(90deg, rgba(245,239,230,0.98), rgba(245,239,230,0.95)); border-bottom: 1px solid rgba(78,52,46,0.08);">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('home') }}" class="text-muted hover:text-accent transition-colors">Home</a></li>
                <li><span class="text-muted/50">/</span></li>
                <li><a href="{{ route('shop.index') }}" class="text-muted hover:text-accent transition-colors">Shop</a>
                </li>
                @if($product->category)
                    <li><span class="text-muted/50">/</span></li>
                    <li><a href="{{ route('shop.index', ['category' => $product->category->slug]) }}"
                            class="text-muted hover:text-accent transition-colors">{{ $product->category->name }}</a></li>
                @endif
                <li><span class="text-muted/50">/</span></li>
                <li class="text-heading font-medium truncate">{{ $product->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- Product Detail -->
    <section class="py-section">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Image Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div id="main-image-container" class="aspect-square bg-white rounded-xl overflow-hidden image-zoom"
                        style="box-shadow: 0 4px 20px rgba(78,52,46,0.08);">
                        @if($product->primary_image)
                            <img id="main-image" src="{{ $product->primary_image->large_url }}"
                                alt="{{ $product->primary_image->alt }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-secondary">
                                <svg class="w-24 h-24 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-3">
                            @foreach($product->images as $image)
                                <button type="button"
                                    class="aspect-square rounded-lg overflow-hidden border-2 transition-all hover:border-accent thumbnail-btn {{ $image->is_primary ? 'border-accent' : 'border-transparent' }}"
                                    onclick="changeMainImage('{{ $image->large_url }}', this)"
                                    data-image-url="{{ $image->large_url }}">
                                    <img src="{{ $image->thumbnail_url }}" alt="{{ $image->alt }}"
                                        class="w-full h-full object-cover" loading="lazy">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    <!-- Category -->
                    @if($product->category)
                        <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}"
                            class="inline-flex items-center text-xs font-medium uppercase tracking-wider transition-colors"
                            style="color: #C9A24D;">
                            {{ $product->category->name }}
                        </a>
                    @endif

                    <!-- Title -->
                    <h1 class="font-heading font-bold text-heading mt-2 mb-4"
                        style="font-size: clamp(1.5rem, 3vw, 2.5rem);">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="text-3xl font-bold text-accent">
                            {{ config('cafe.currency.symbol') }}{{ number_format($product->current_price) }}
                        </span>
                        @if($product->has_discount)
                            <span class="text-xl text-muted line-through">
                                {{ config('cafe.currency.symbol') }}{{ number_format($product->price) }}
                            </span>
                            <span class="bg-accent/20 text-accent text-sm font-semibold px-3 py-1 rounded">
                                Save {{ $product->discount_percentage }}%
                            </span>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-6">
                        @if($product->is_in_stock)
                            @if($product->stock !== null)
                                <span
                                    class="inline-flex items-center text-sm {{ $product->stock <= 5 ? 'text-orange-600' : 'text-green-600' }}">
                                    <span
                                        class="w-2 h-2 rounded-full {{ $product->stock <= 5 ? 'bg-orange-500' : 'bg-green-500' }} mr-2"></span>
                                    @if($product->stock <= 5)
                                        Only {{ $product->stock }} left in stock
                                    @else
                                        In Stock
                                    @endif
                                </span>
                            @else
                                <span class="inline-flex items-center text-sm text-green-600">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    In Stock
                                </span>
                            @endif
                        @else
                            <span class="inline-flex items-center text-sm text-red-600">
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose prose-brown mb-8">
                        <h3 class="font-heading text-lg font-semibold text-heading mb-2">Description</h3>
                        <p class="text-body leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Add to Cart -->
                    @if($product->is_in_stock)
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <!-- Quantity -->
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-sm font-medium text-heading">Quantity:</label>
                                <div class="flex items-center border border-primary/20 rounded-lg">
                                    <button type="button" onclick="updateQuantity(-1)"
                                        class="px-4 py-2 text-muted hover:text-heading transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                                        max="{{ $product->stock ?? 99 }}"
                                        class="w-16 text-center border-0 focus:ring-0 text-heading font-medium">
                                    <button type="button" onclick="updateQuantity(1)"
                                        class="px-4 py-2 text-muted hover:text-heading transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <x-button type="submit" variant="accent" size="lg" class="w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Add to Cart
                            </x-button>
                        </form>
                    @else
                        <button disabled
                            class="w-full sm:w-auto bg-muted/30 text-muted py-3 px-8 rounded-lg font-semibold cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif

                    <!-- Additional Info -->
                    <div class="mt-8 pt-8 border-t border-primary/10">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-muted">Category:</span>
                                <span
                                    class="text-heading font-medium ml-1">{{ $product->category?->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div>
                                <span class="text-muted">SKU:</span>
                                <span
                                    class="text-heading font-medium ml-1">CN-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section class="py-section section-cream">
            <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="accent-line mb-3"></span>
                        <h2 class="font-heading text-h2 font-bold text-heading">You May Also Like</h2>
                    </div>
                    <a href="{{ route('shop.index') }}"
                        class="hidden sm:inline-flex items-center text-accent font-semibold text-sm group">
                        View All
                        <svg class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <x-product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
        <script>
            // Quantity controls
            function updateQuantity(change) {
                const input = document.getElementById('quantity');
                const newValue = parseInt(input.value) + change;
                const min = parseInt(input.min);
                const max = parseInt(input.max);

                if (newValue >= min && newValue <= max) {
                    input.value = newValue;
                }
            }

            // Image gallery
            function changeMainImage(url, button) {
                document.getElementById('main-image').src = url;

                // Update active thumbnail
                document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                    btn.classList.remove('border-accent');
                    btn.classList.add('border-transparent');
                });
                button.classList.remove('border-transparent');
                button.classList.add('border-accent');
            }
        </script>
    @endpush
</x-app-layout>