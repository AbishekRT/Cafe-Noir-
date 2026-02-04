{{--
Shopping Cart Page
Features: Cart items, Quantity update, Remove items, Order summary
--}}
<x-app-layout>
    <x-slot name="title">Shopping Cart - Cafe Noir</x-slot>

    <!-- Page Header -->
    <section class="bg-primary text-white py-12">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-h1 font-bold">Your Cart</h1>
        </div>
    </section>

    <section class="py-section">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Cart Messages -->
            @if(count($messages) > 0)
                <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <ul class="list-disc list-inside text-sm text-yellow-800 space-y-1">
                        @foreach($messages as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($items->count() > 0)
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($items as $item)
                            <div class="bg-white rounded-lg shadow-subtle p-4 flex flex-col sm:flex-row gap-4">
                                <!-- Product Image -->
                                <a href="{{ route('shop.show', $item['slug']) }}" class="flex-shrink-0">
                                    @if($item['image'])
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                            class="w-24 h-24 object-cover rounded-lg">
                                    @else
                                        <div class="w-24 h-24 bg-secondary rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>

                                <!-- Product Info -->
                                <div class="flex-grow">
                                    <a href="{{ route('shop.show', $item['slug']) }}"
                                        class="font-heading text-lg font-semibold text-heading hover:text-accent transition-colors">
                                        {{ $item['name'] }}
                                    </a>

                                    <!-- Price -->
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="text-accent font-semibold">
                                            {{ config('cafe.currency.symbol') }}{{ number_format($item['price'], 2) }}
                                        </span>
                                        @if($item['has_discount'] && $item['original_price'] > $item['price'])
                                            <span class="text-sm text-muted line-through">
                                                {{ config('cafe.currency.symbol') }}{{ number_format($item['original_price'], 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center justify-between mt-4">
                                        <form action="{{ route('cart.update') }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <div class="flex items-center border border-primary/20 rounded-lg">
                                                <button type="submit" name="quantity"
                                                    value="{{ max(0, $item['quantity'] - 1) }}"
                                                    class="px-3 py-1 text-muted hover:text-heading transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <span
                                                    class="w-10 text-center text-heading font-medium">{{ $item['quantity'] }}</span>
                                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                                    class="px-3 py-1 text-muted hover:text-heading transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Item Total -->
                                        <div class="text-right">
                                            <span class="text-lg font-bold text-heading">
                                                {{ config('cafe.currency.symbol') }}{{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove') }}" method="POST" class="self-start">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <button type="submit" class="text-muted hover:text-red-500 transition-colors p-2"
                                        title="Remove item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach

                        <!-- Clear Cart -->
                        <div class="flex justify-between items-center pt-4">
                            <a href="{{ route('shop.index') }}"
                                class="text-accent hover:text-primary transition-colors text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Continue Shopping
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-muted hover:text-red-500 transition-colors text-sm font-medium">
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-subtle p-6 sticky top-24">
                            <h2 class="font-heading text-xl font-bold text-heading mb-6">Order Summary</h2>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-muted">Subtotal</span>
                                    <span
                                        class="text-heading font-medium">{{ config('cafe.currency.symbol') }}{{ number_format($subtotal, 2) }}</span>
                                </div>
                                @if($taxRate > 0)
                                    <div class="flex justify-between">
                                        <span class="text-muted">Tax ({{ $taxRate }}%)</span>
                                        <span
                                            class="text-heading font-medium">{{ config('cafe.currency.symbol') }}{{ number_format($tax, 2) }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-muted">Shipping</span>
                                    <span class="text-green-600 font-medium">Free</span>
                                </div>
                            </div>

                            <div class="border-t border-primary/10 mt-4 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="font-heading text-lg font-semibold text-heading">Total</span>
                                    <span
                                        class="text-2xl font-bold text-accent">{{ config('cafe.currency.symbol') }}{{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <x-button href="{{ route('checkout.index') }}" variant="accent" size="lg" class="w-full mt-6">
                                Proceed to Checkout
                            </x-button>

                            <p class="text-xs text-muted text-center mt-4">
                                Secure checkout powered by industry-standard encryption
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-muted/30 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <h2 class="font-heading text-2xl font-bold text-heading mb-2">Your Cart is Empty</h2>
                    <p class="text-muted mb-8">Looks like you haven't added any items to your cart yet.</p>
                    <x-button href="{{ route('shop.index') }}" variant="primary" size="lg">
                        Start Shopping
                    </x-button>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
