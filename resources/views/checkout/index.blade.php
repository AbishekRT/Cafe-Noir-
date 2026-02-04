{{-- 
    Checkout Page
    Features: Customer info form, Order summary, Payment selection
--}}
<x-app-layout>
    <x-slot name="title">Checkout - Cafe Noir</x-slot>

    <!-- Page Header -->
    <section class="bg-primary text-white py-12">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-h1 font-bold">Checkout</h1>
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

            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Checkout Form -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Customer Information -->
                        <div class="bg-white rounded-lg shadow-subtle p-6">
                            <h2 class="font-heading text-xl font-bold text-heading mb-6">Customer Information</h2>
                            
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-heading mb-1">Full Name *</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        value="{{ old('name', auth()->user()?->name) }}"
                                        required
                                        class="w-full border border-primary/20 rounded-lg py-2 px-4 focus:ring-accent focus:border-accent @error('name') border-red-500 @enderror"
                                    >
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-heading mb-1">Email Address *</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        value="{{ old('email', auth()->user()?->email) }}"
                                        required
                                        class="w-full border border-primary/20 rounded-lg py-2 px-4 focus:ring-accent focus:border-accent @error('email') border-red-500 @enderror"
                                    >
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-heading mb-1">Phone Number *</label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        id="phone" 
                                        value="{{ old('phone') }}"
                                        required
                                        class="w-full border border-primary/20 rounded-lg py-2 px-4 focus:ring-accent focus:border-accent @error('phone') border-red-500 @enderror"
                                    >
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-heading mb-1">Shipping Address *</label>
                                    <textarea 
                                        name="address" 
                                        id="address" 
                                        rows="3"
                                        required
                                        class="w-full border border-primary/20 rounded-lg py-2 px-4 focus:ring-accent focus:border-accent @error('address') border-red-500 @enderror"
                                    >{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-heading mb-1">Order Notes (Optional)</label>
                                    <textarea 
                                        name="notes" 
                                        id="notes" 
                                        rows="2"
                                        placeholder="Special instructions for delivery..."
                                        class="w-full border border-primary/20 rounded-lg py-2 px-4 focus:ring-accent focus:border-accent"
                                    >{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white rounded-lg shadow-subtle p-6">
                            <h2 class="font-heading text-xl font-bold text-heading mb-6">Payment Method</h2>
                            
                            <div class="space-y-4">
                                <!-- Cash on Delivery -->
                                <label class="flex items-start p-4 border border-primary/20 rounded-lg cursor-pointer hover:bg-secondary/50 transition-colors has-[:checked]:border-accent has-[:checked]:bg-accent/5">
                                    <input 
                                        type="radio" 
                                        name="payment_method" 
                                        value="cod" 
                                        class="mt-1 text-accent focus:ring-accent"
                                        {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                                    >
                                    <div class="ml-3">
                                        <span class="font-medium text-heading">Cash on Delivery</span>
                                        <p class="text-sm text-muted mt-1">Pay when you receive your order</p>
                                    </div>
                                </label>

                                <!-- Stripe Payment -->
                                @if($stripeEnabled)
                                    <label class="flex items-start p-4 border border-primary/20 rounded-lg cursor-pointer hover:bg-secondary/50 transition-colors has-[:checked]:border-accent has-[:checked]:bg-accent/5">
                                        <input 
                                            type="radio" 
                                            name="payment_method" 
                                            value="stripe" 
                                            class="mt-1 text-accent focus:ring-accent"
                                            {{ old('payment_method') === 'stripe' ? 'checked' : '' }}
                                        >
                                        <div class="ml-3">
                                            <span class="font-medium text-heading">Credit Card (Stripe)</span>
                                            <p class="text-sm text-muted mt-1">Pay securely with your credit or debit card</p>
                                            <div class="flex items-center space-x-2 mt-2">
                                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded">Visa</span>
                                                <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded">Mastercard</span>
                                                <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded">Amex</span>
                                            </div>
                                        </div>
                                    </label>
                                @endif

                                @error('payment_method')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Demo Payment Simulation -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-800 mb-3">
                                <strong>Demo Mode:</strong> For testing purposes, you can simulate a successful payment without actually processing a charge.
                            </p>
                            <button 
                                type="button" 
                                onclick="simulatePayment()"
                                class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                            >
                                Simulate Payment Success
                            </button>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-subtle p-6 sticky top-24">
                            <h2 class="font-heading text-xl font-bold text-heading mb-6">Order Summary</h2>

                            <!-- Items -->
                            <div class="space-y-4 mb-6">
                                @foreach($items as $item)
                                    <div class="flex gap-3">
                                        @if($item['image'])
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-secondary rounded flex items-center justify-center">
                                                <svg class="w-6 h-6 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-grow">
                                            <p class="text-sm font-medium text-heading line-clamp-1">{{ $item['name'] }}</p>
                                            <p class="text-xs text-muted">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                        <span class="text-sm font-medium text-heading">
                                            {{ config('cafe.currency.symbol') }}{{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-primary/10 pt-4 space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-muted">Subtotal</span>
                                    <span class="text-heading font-medium">{{ config('cafe.currency.symbol') }}{{ number_format($subtotal, 2) }}</span>
                                </div>
                                @if($taxRate > 0)
                                    <div class="flex justify-between">
                                        <span class="text-muted">Tax ({{ $taxRate }}%)</span>
                                        <span class="text-heading font-medium">{{ config('cafe.currency.symbol') }}{{ number_format($tax, 2) }}</span>
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
                                    <span class="text-2xl font-bold text-accent">{{ config('cafe.currency.symbol') }}{{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <x-button type="submit" variant="accent" size="lg" class="w-full mt-6">
                                Place Order
                            </x-button>

                            <a href="{{ route('cart.index') }}" class="block text-center text-sm text-muted hover:text-accent transition-colors mt-4">
                                ← Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Simulation Form (Hidden) -->
            <form id="simulate-form" action="{{ route('checkout.simulate') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="name" id="sim-name">
                <input type="hidden" name="email" id="sim-email">
                <input type="hidden" name="phone" id="sim-phone">
                <input type="hidden" name="address" id="sim-address">
                <input type="hidden" name="notes" id="sim-notes">
            </form>
        </div>
    </section>

    @push('scripts')
    <script>
        function simulatePayment() {
            // Copy values from checkout form to simulation form
            document.getElementById('sim-name').value = document.getElementById('name').value;
            document.getElementById('sim-email').value = document.getElementById('email').value;
            document.getElementById('sim-phone').value = document.getElementById('phone').value;
            document.getElementById('sim-address').value = document.getElementById('address').value;
            document.getElementById('sim-notes').value = document.getElementById('notes').value;

            // Validate required fields
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;

            if (!name || !email || !phone || !address) {
                alert('Please fill in all required fields before simulating payment.');
                return;
            }

            // Submit simulation form
            document.getElementById('simulate-form').submit();
        }
    </script>
    @endpush
</x-app-layout>

