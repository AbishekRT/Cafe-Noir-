{{--
Product Card Component
Displays product information in a card format
Usage: <x-product-card :product="$product" />
--}}
@props(['product'])

<article class="product-card-enhanced bg-white rounded-xl overflow-hidden group"
    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
    <!-- Product Image -->
    <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden aspect-square">
        @if($product->primary_image)
            <img src="{{ $product->primary_image->medium_url }}" alt="{{ $product->primary_image->alt }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
        @else
            <div class="w-full h-full bg-secondary flex items-center justify-center">
                <svg class="w-16 h-16 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif

        <!-- Image Overlay on Hover -->
        <div class="card-image-overlay"></div>

        <!-- Quick View on Hover -->
        <div class="card-quick-view absolute bottom-4 left-4 right-4">
            <span class="inline-flex items-center text-white text-xs font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
                View Details
            </span>
        </div>

        <!-- Discount Badge -->
        @if($product->has_discount)
            <span class="absolute top-3 left-3 text-xs font-bold px-3 py-1 rounded-full"
                style="background: #C9A24D; color: #2E1F1A; box-shadow: 0 2px 8px rgba(201,162,77,0.3);">
                -{{ $product->discount_percentage }}%
            </span>
        @endif

        <!-- Out of Stock Overlay -->
        @if(!$product->is_in_stock)
            <div class="absolute inset-0 flex items-center justify-center"
                style="background: rgba(78,52,46,0.7); backdrop-filter: blur(2px);">
                <span class="bg-white text-primary font-semibold px-5 py-2 rounded-full text-sm">Out of Stock</span>
            </div>
        @endif
    </a>

    <!-- Product Info -->
    <div class="p-5">
        <!-- Category -->
        @if($product->category)
            <span class="text-xs text-accent uppercase tracking-wider font-medium">
                {{ $product->category->name }}
            </span>
        @endif

        <!-- Title -->
        <h3 class="font-heading text-lg font-semibold text-heading mt-1 mb-3 line-clamp-2">
            <a href="{{ route('shop.show', $product->slug) }}" class="hover:text-accent transition-colors duration-200">
                {{ $product->name }}
            </a>
        </h3>

        <!-- Price -->
        <div class="flex items-center space-x-2 mb-4">
            <span class="text-lg font-bold text-accent">
                {{ config('cafe.currency.symbol') }} {{ number_format($product->current_price) }}
            </span>
            @if($product->has_discount)
                <span class="text-sm text-muted line-through">
                    {{ config('cafe.currency.symbol') }} {{ number_format($product->price) }}
                </span>
            @endif
        </div>

        <!-- Add to Cart Button -->
        @if($product->is_in_stock)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                    class="btn-glow w-full py-2.5 px-4 rounded-lg text-sm font-semibold transition-all duration-300"
                    style="background: #4E342E; color: white;">
                    Add to Cart
                </button>
            </form>
        @else
            <button disabled class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold cursor-not-allowed"
                style="background: rgba(122,106,101,0.15); color: #7A6A65;">
                Out of Stock
            </button>
        @endif
    </div>
</article>