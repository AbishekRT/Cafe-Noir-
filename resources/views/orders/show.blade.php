{{--
Order Detail Page (Customer)
Shows detailed order information for authenticated users
--}}
<x-app-layout>
    <x-slot name="title">Order #{{ $order->order_number }} - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-secondary">
        <!-- Page Header -->
        <div class="bg-primary">
            <div class="container mx-auto px-4 py-8">
                <nav class="text-secondary/60 text-sm mb-2">
                    <a href="{{ route('home') }}" class="hover:text-secondary">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('orders.index') }}" class="hover:text-secondary">My Orders</a>
                    <span class="mx-2">/</span>
                    <span class="text-secondary">#{{ $order->order_number }}</span>
                </nav>
                <h1 class="text-3xl font-heading font-bold text-secondary">Order #{{ $order->order_number }}</h1>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Status -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Order Status</h2>

                        @php
                            $steps = ['pending' => 1, 'processing' => 2, 'shipped' => 3, 'delivered' => 4];
                            $currentStep = $steps[$order->status] ?? 0;
                            $isCancelled = $order->status === 'cancelled';
                        @endphp

                        @if($isCancelled)
                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-center">
                                <svg class="w-8 h-8 text-red-500 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="font-medium text-red-800">This order has been cancelled</p>
                            </div>
                        @else
                            <div class="flex items-center justify-between">
                                @foreach(['Pending', 'Processing', 'Shipped', 'Delivered'] as $index => $step)
                                    <div class="flex flex-col items-center relative {{ $index < 3 ? 'flex-1' : '' }}">
                                        <div
                                            class="w-10 h-10 rounded-full flex items-center justify-center {{ ($index + 1) <= $currentStep ? 'bg-accent text-primary' : 'bg-gray-200 text-gray-500' }}">
                                            @if(($index + 1) < $currentStep)
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </div>
                                        <span
                                            class="text-xs mt-2 {{ ($index + 1) <= $currentStep ? 'text-heading font-medium' : 'text-muted' }}">{{ $step }}</span>
                                        @if($index < 3)
                                            <div
                                                class="absolute top-5 left-1/2 w-full h-0.5 {{ ($index + 1) < $currentStep ? 'bg-accent' : 'bg-gray-200' }}">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-heading font-semibold text-heading">Order Items</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <div class="p-6 flex items-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item->product && $item->product->primaryImage)
                                            <img src="{{ asset('storage/' . $item->product->primaryImage->thumbnail_path) }}"
                                                alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h3 class="font-medium text-heading">{{ $item->product_name }}</h3>
                                        <p class="text-sm text-muted">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-muted">Rs. {{ number_format($item->price) }} each</p>
                                        <p class="font-medium text-heading">
                                            Rs. {{ number_format($1) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Shipping Address</h2>
                        <address class="not-italic text-body">
                            {{ $order->customer_name }}<br>
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
                            {{ $order->shipping_country }}
                        </address>
                        @if($order->notes)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-muted">Order Notes:</p>
                                <p class="text-body mt-1">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Order Summary</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-muted">Order Date</span>
                                <span class="text-heading">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-muted">Subtotal</span>
                                <span class="text-heading">Rs. {{ number_format($order->subtotal) }}</span>
                            </div>
                            @if($order->tax > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-muted">Tax</span>
                                    <span class="text-heading">Rs. {{ number_format($order->tax) }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <span class="text-muted">Shipping</span>
                                @if($order->shipping_cost > 0)
                                    <span class="text-heading">Rs. {{ number_format($order->shipping_cost) }}</span>
                                @else
                                    <span class="text-green-600">Free</span>
                                @endif
                            </div>
                            <div class="pt-3 border-t border-gray-200 flex justify-between text-lg font-bold">
                                <span class="text-heading">Total</span>
                                <span class="text-heading">Rs. {{ number_format($order->total) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Payment</h2>
                        <div class="flex items-center">
                            @if($order->payment_method === 'cod')
                                <svg class="w-8 h-8 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium text-heading">Cash on Delivery</p>
                                    <p
                                        class="text-sm {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </p>
                                </div>
                            @else
                                <svg class="w-8 h-8 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium text-heading">Credit Card</p>
                                    <p class="text-sm text-green-600">Paid</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="bg-primary/5 rounded-xl p-6">
                        <h3 class="font-heading font-semibold text-heading mb-2">Need Help?</h3>
                        <p class="text-sm text-muted mb-4">If you have any questions about your order, please contact
                            us.</p>
                        <a href="{{ route('pages.contact') }}"
                            class="inline-flex items-center text-accent hover:text-accent/80 font-medium text-sm">
                            Contact Support
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

