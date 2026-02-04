{{--
Order Confirmation Page
Displays after successful checkout
--}}
<x-app-layout>
    <x-slot name="title">Order Confirmed - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-secondary">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-2xl mx-auto text-center">
                <!-- Success Icon -->
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h1 class="text-4xl font-heading font-bold text-heading mb-4">Thank You for Your Order!</h1>
                <p class="text-lg text-body mb-8">
                    Your order has been placed successfully. We've sent a confirmation email to
                    <span class="font-medium text-heading">{{ $order->customer_email }}</span>
                </p>

                <!-- Order Details Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8 text-left">
                    <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <p class="text-sm text-muted">Order Number</p>
                            <p class="text-xl font-bold text-heading">#{{ $order->order_number }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-muted">Order Date</p>
                            <p class="text-lg font-medium text-heading">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-6">
                        <h3 class="font-medium text-heading mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-sm text-primary mr-3">
                                            {{ $item->quantity }}
                                        </span>
                                        <span class="text-body">{{ $item->product_name }}</span>
                                    </div>
                                    <span
                                        class="font-medium text-heading">Rs. {{ number_format($1) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="border-t border-gray-200 pt-6 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-muted">Subtotal</span>
                            <span class="text-body">Rs. {{ number_format($order->subtotal) }}</span>
                        </div>
                        @if($order->tax > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-muted">Tax</span>
                                <span class="text-body">Rs. {{ number_format($order->tax) }}</span>
                            </div>
                        @endif
                        @if($order->shipping_cost > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-muted">Shipping</span>
                                <span class="text-body">Rs. {{ number_format($order->shipping_cost) }}</span>
                            </div>
                        @else
                            <div class="flex justify-between text-sm">
                                <span class="text-muted">Shipping</span>
                                <span class="text-green-600">Free</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-100">
                            <span class="text-heading">Total</span>
                            <span class="text-heading">Rs. {{ number_format($order->total) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8 text-left">
                    <h3 class="font-medium text-heading mb-4">Shipping Address</h3>
                    <address class="not-italic text-body">
                        {{ $order->customer_name }}<br>
                        {{ $order->shipping_address }}<br>
                        {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
                        {{ $order->shipping_country }}
                    </address>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8 text-left">
                    <h3 class="font-medium text-heading mb-4">Payment Method</h3>
                    <div class="flex items-center">
                        @if($order->payment_method === 'cod')
                            <svg class="w-8 h-8 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <div>
                                <p class="font-medium text-heading">Cash on Delivery</p>
                                <p class="text-sm text-muted">Pay when you receive your order</p>
                            </div>
                        @else
                            <svg class="w-8 h-8 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            <div>
                                <p class="font-medium text-heading">Credit Card</p>
                                <p class="text-sm text-green-600">Payment completed successfully</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- What's Next -->
                <div class="bg-primary/5 rounded-xl p-8 mb-8">
                    <h3 class="font-heading font-semibold text-heading text-lg mb-4">What's Next?</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                        <div class="flex items-start">
                            <div
                                class="w-10 h-10 bg-accent/20 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                <span class="text-accent font-bold">1</span>
                            </div>
                            <div>
                                <p class="font-medium text-heading">Order Confirmation</p>
                                <p class="text-sm text-muted">Check your email for details</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="w-10 h-10 bg-accent/20 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                <span class="text-accent font-bold">2</span>
                            </div>
                            <div>
                                <p class="font-medium text-heading">Processing</p>
                                <p class="text-sm text-muted">We'll prepare your order</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="w-10 h-10 bg-accent/20 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                <span class="text-accent font-bold">3</span>
                            </div>
                            <div>
                                <p class="font-medium text-heading">Delivery</p>
                                <p class="text-sm text-muted">Receive within 3-5 days</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('shop.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-primary text-secondary font-medium rounded-lg hover:bg-primary/90 transition-colors">
                        Continue Shopping
                    </a>
                    @auth
                        <a href="{{ route('orders.index') }}"
                            class="inline-flex items-center justify-center px-8 py-4 border-2 border-primary text-primary font-medium rounded-lg hover:bg-primary hover:text-secondary transition-colors">
                            View My Orders
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

