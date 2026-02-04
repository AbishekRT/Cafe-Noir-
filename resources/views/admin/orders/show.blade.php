{{--
Admin Order Detail
Features: Order details, status update, order history
--}}
<x-app-layout>
    <x-slot name="title">Order #{{ $order->order_number }} - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <nav class="text-secondary/60 text-sm mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                            <span class="mx-2">/</span>
                            <a href="{{ route('admin.orders.index') }}" class="hover:text-secondary">Orders</a>
                            <span class="mx-2">/</span>
                            <span class="text-secondary">#{{ $order->order_number }}</span>
                        </nav>
                        <h1 class="text-2xl font-heading font-bold text-secondary">Order #{{ $order->order_number }}
                        </h1>
                    </div>
                    <a href="{{ route('admin.orders.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-secondary/20 text-secondary text-sm font-medium rounded-lg hover:bg-secondary/30 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Orders
                    </a>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Items -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-heading font-semibold text-heading">Order Items</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <div class="p-6 flex items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
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
                                        <p class="text-sm text-muted">SKU: {{ $item->product_sku ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-muted">{{ $item->quantity }} ×
                                            ${{ number_format($item->price, 2) }}</p>
                                        <p class="font-medium text-heading">
                                            ${{ number_format($item->quantity * $item->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-muted">Subtotal</span>
                                    <span class="text-heading">${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                @if($order->tax > 0)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-muted">Tax</span>
                                        <span class="text-heading">${{ number_format($order->tax, 2) }}</span>
                                    </div>
                                @endif
                                @if($order->shipping_cost > 0)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-muted">Shipping</span>
                                        <span class="text-heading">${{ number_format($order->shipping_cost, 2) }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between text-lg font-semibold pt-2 border-t border-gray-200">
                                    <span class="text-heading">Total</span>
                                    <span class="text-heading">${{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-heading font-semibold text-heading">Customer Information</h2>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Contact Info -->
                            <div>
                                <h3 class="text-sm font-medium text-muted uppercase tracking-wider mb-3">Contact</h3>
                                <p class="font-medium text-heading">{{ $order->customer_name }}</p>
                                <p class="text-body">{{ $order->customer_email }}</p>
                                <p class="text-body">{{ $order->customer_phone }}</p>
                            </div>

                            <!-- Shipping Address -->
                            <div>
                                <h3 class="text-sm font-medium text-muted uppercase tracking-wider mb-3">Shipping
                                    Address</h3>
                                <p class="text-body">{{ $order->shipping_address }}</p>
                                <p class="text-body">{{ $order->shipping_city }}, {{ $order->shipping_state }}
                                    {{ $order->shipping_zip }}</p>
                                <p class="text-body">{{ $order->shipping_country }}</p>
                            </div>
                        </div>

                        @if($order->notes)
                            <div class="px-6 pb-6">
                                <h3 class="text-sm font-medium text-muted uppercase tracking-wider mb-3">Order Notes</h3>
                                <p class="text-body bg-gray-50 p-4 rounded-lg">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Order History -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-heading font-semibold text-heading">Order History</h2>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <!-- Timeline -->
                                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                                <div class="space-y-6">
                                    @forelse($order->statusHistory->sortByDesc('created_at') as $history)
                                        <div class="relative pl-10">
                                            <div
                                                class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center {{ $loop->first ? 'bg-accent' : 'bg-gray-200' }}">
                                                <svg class="w-4 h-4 {{ $loop->first ? 'text-primary' : 'text-gray-500' }}"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-heading">
                                                    Status changed to <span class="capitalize">{{ $history->status }}</span>
                                                </p>
                                                @if($history->notes)
                                                    <p class="text-sm text-body mt-1">{{ $history->notes }}</p>
                                                @endif
                                                <p class="text-xs text-muted mt-1">
                                                    {{ $history->created_at->format('M d, Y h:i A') }}
                                                    @if($history->changedBy)
                                                        by {{ $history->changedBy->name }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="relative pl-10">
                                            <div
                                                class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center bg-accent">
                                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-heading">Order created</p>
                                                <p class="text-xs text-muted mt-1">
                                                    {{ $order->created_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Order Status -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Order Status</h2>

                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
                                'delivered' => 'bg-green-100 text-green-800 border-green-200',
                                'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                            ];
                        @endphp

                        <div
                            class="p-4 rounded-lg border {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }} mb-4">
                            <p class="text-lg font-semibold capitalize">{{ $order->status }}</p>
                        </div>

                        @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST"
                                class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label for="status" class="block text-sm font-medium text-heading mb-2">
                                        Update Status
                                    </label>
                                    <select id="status" name="status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                                            Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                            Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-heading mb-2">
                                        Notes (Optional)
                                    </label>
                                    <textarea id="notes" name="notes" rows="2"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent resize-none"
                                        placeholder="Add a note about this status change"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full px-4 py-3 bg-accent text-primary font-medium rounded-lg hover:bg-accent/90 transition-colors">
                                    Update Status
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Payment</h2>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-muted">Method</span>
                                <span class="font-medium text-heading">
                                    {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Credit Card' }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-muted">Status</span>
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                            @if($order->stripe_payment_id)
                                <div class="flex justify-between">
                                    <span class="text-muted">Transaction ID</span>
                                    <span
                                        class="text-sm text-body font-mono">{{ Str::limit($order->stripe_payment_id, 20) }}</span>
                                </div>
                            @endif
                        </div>

                        @if($order->payment_status !== 'paid' && $order->payment_method === 'cod')
                            <form action="{{ route('admin.orders.mark-paid', $order) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="w-full px-4 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                                    Mark as Paid
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Order Meta -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Order Details</h2>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-muted">Order Number</span>
                                <span class="font-medium text-heading">#{{ $order->order_number }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-muted">Order Date</span>
                                <span class="text-body">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-muted">Order Time</span>
                                <span class="text-body">{{ $order->created_at->format('h:i A') }}</span>
                            </div>
                            @if($order->user)
                                <div class="flex justify-between">
                                    <span class="text-muted">Customer Account</span>
                                    <span class="text-accent">Registered</span>
                                </div>
                            @else
                                <div class="flex justify-between">
                                    <span class="text-muted">Customer Account</span>
                                    <span class="text-body">Guest</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
