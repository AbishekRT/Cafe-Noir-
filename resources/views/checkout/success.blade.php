{{--
Order Success/Confirmation Page
Features: Order details, Summary, Next steps
--}}
<x-app-layout>
    <x-slot name="title">Order Confirmed - Cafe Noir</x-slot>

    <section class="py-section">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Message -->
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="font-heading text-h1 font-bold text-heading mb-4">Thank You!</h1>
                <p class="text-lg text-muted">Your order has been placed successfully.</p>
            </div>

            <!-- Order Details Card -->
            <div class="bg-white rounded-lg shadow-card p-6 md:p-8 mb-8">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-6 border-b border-primary/10">
                    <div>
                        <h2 class="font-heading text-xl font-bold text-heading">Order #{{ $order->order_number }}</h2>
                        <p class="text-sm text-muted mt-1">Placed on
                            {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    <span
                        class="mt-2 sm:mt-0 px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge_class }}">
                        {{ $order->status_label }}
                    </span>
                </div>

                <!-- Customer Info -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-semibold text-heading mb-2">Customer Details</h3>
                        <p class="text-body">{{ $order->customer_name }}</p>
                        <p class="text-muted text-sm">{{ $order->customer_email }}</p>
                        <p class="text-muted text-sm">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-heading mb-2">Shipping Address</h3>
                        <p class="text-body whitespace-pre-line">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="border-t border-primary/10 pt-6">
                    <h3 class="font-semibold text-heading mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4">
                                @if($item->product && $item->product->primary_image)
                                    <img src="{{ $item->product->primary_image->thumbnail_url }}"
                                        alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-secondary rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-grow">
                                    <p class="font-medium text-heading">{{ $item->product_name }}</p>
                                    <p class="text-sm text-muted">Qty: {{ $item->quantity }} ×
                                        {{ config('cafe.currency.symbol') }}{{ number_format($item->price, 2) }}</p>
                                </div>
                                <span class="font-semibold text-heading">
                                    {{ config('cafe.currency.symbol') }}{{ number_format($item->total, 2) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Totals -->
                <div class="border-t border-primary/10 mt-6 pt-6 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-muted">Subtotal</span>
                        <span
                            class="text-heading">{{ config('cafe.currency.symbol') }}{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->tax > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-muted">Tax</span>
                            <span
                                class="text-heading">{{ config('cafe.currency.symbol') }}{{ number_format($order->tax, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-sm">
                        <span class="text-muted">Shipping</span>
                        <span class="text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-primary/10">
                        <span class="font-heading text-lg font-bold text-heading">Total</span>
                        <span
                            class="text-xl font-bold text-accent">{{ config('cafe.currency.symbol') }}{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="bg-secondary rounded-lg p-4 mt-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-muted">Payment Method</p>
                            <p class="font-medium text-heading">{{ $order->payment_method_label }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-muted">Payment Status</p>
                            <p
                                class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($order->payment_status) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                <h3 class="font-heading text-lg font-semibold text-blue-800 mb-3">What's Next?</h3>
                <ul class="space-y-2 text-sm text-blue-700">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        A confirmation email has been sent to {{ $order->customer_email }}
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        We'll notify you when your order ships
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Estimated delivery: 3-5 business days
                    </li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-button href="{{ route('shop.index') }}" variant="primary">
                    Continue Shopping
                </x-button>
                <x-button href="{{ route('home') }}" variant="secondary">
                    Back to Home
                </x-button>
            </div>
        </div>
    </section>
</x-app-layout>
