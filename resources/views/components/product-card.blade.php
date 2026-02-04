{{--
Product Card Component
Displays product information in a card format
Usage: <x-product-card :product="$product" />
--}}
@props(['product'])

<article class="bg-white rounded-lg shadow-card overflow-hidden group transition-all duration-300 hover:shadow-lg">
    <!-- Product Image -->
    <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-square">
        @if($product->primary_image)
            <img src="{{ $product->primary_image->medium_url }}" alt="{{ $product->primary_image->alt }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        @else
            <div class="w-full h-full bg-secondary flex items-center justify-center">
                <svg class="w-16 h-16 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif

        <!-- Discount Badge -->
        @if($product->has_discount)
            <span class="absolute top-3 left-3 bg-accent text-heading text-xs font-bold px-2 py-1 rounded">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        <!-- Out of Stock Overlay -->
        @if(!$product->is_in_stock)
            <div class="absolute inset-0 bg-primary/60 flex items-center justify-center">
                <span class="bg-white text-primary font-semibold px-4 py-2 rounded">Out of Stock</span>
            </div>
        @endif
    </a>

    <!-- Product Info -->
    <div class="p-4">
        <!-- Category -->
        @if($product->category)
            <span class="text-xs text-muted uppercase tracking-wider">
                {{ $product->category->name }}
            </span>
        @endif

        <!-- Title -->
        <h3 class="font-heading text-lg font-semibold text-heading mt-1 mb-2 line-clamp-2">
            <a href="{{ route('shop.show', $product->slug) }}" class="hover:text-accent transition-colors">
                {{ $product->name }}
            </a>
        </h3>

        <!-- Price -->
        <div class="flex items-center space-x-2 mb-3">
            <span class="text-lg font-bold text-accent">
                {{ config('cafe.currency.symbol') }}{{ number_format($product->current_price, 2) }}
            </span>
            @if($product->has_discount)
                <span class="text-sm text-muted line-through">
                    {{ config('cafe.currency.symbol') }}{{ number_format($product->price, 2) }}
                </span>
            @endif
        </div>

        <!-- Add to Cart Button -->
        @if($product->is_in_stock)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                    class="w-full bg-primary text-white py-2 px-4 rounded text-btn font-semibold hover:bg-primary/90 transition-colors">
                    Add to Cart
                </button>
            </form>
        @else
            <button disabled
                class="w-full bg-muted/30 text-muted py-2 px-4 rounded text-btn font-semibold cursor-not-allowed">
                Out of Stock
            </button>
        @endif
    </div>
</article>


