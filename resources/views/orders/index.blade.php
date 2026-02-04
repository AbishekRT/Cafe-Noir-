{{--
My Orders Page (Customer)
Shows order history for authenticated users
--}}
<x-app-layout>
    <x-slot name="title">My Orders - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-secondary">
        <!-- Page Header -->
        <div class="bg-primary">
            <div class="container mx-auto px-4 py-8">
                <nav class="text-secondary/60 text-sm mb-2">
                    <a href="{{ route('home') }}" class="hover:text-secondary">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-secondary">My Orders</span>
                </nav>
                <h1 class="text-3xl font-heading font-bold text-secondary">My Orders</h1>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            @if($orders->count() > 0)
                <div class="space-y-6">
                    @foreach($orders as $order)
                                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                        <!-- Order Header -->
                                        <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
                                            <div>
                                                <div class="flex items-center gap-3">
                                                    <span class="font-medium text-heading">Order #{{ $order->order_number }}</span>
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                                            'processing' => 'bg-blue-100 text-blue-800',
                                                            'shipped' => 'bg-purple-100 text-purple-800',
                                                            'delivered' => 'bg-green-100 text-green-800',
                                                            'cancelled' => 'bg-red-100 text-red-800',
                                                        ];
                                                    @endphp
                         <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-muted mt-1">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                                            </div>
                                            <a href="{{ route('orders.show', $order) }}"
                                                class="text-accent hover:text-accent/80 font-medium text-sm">
                                                View Details →
                                            </a>
                                        </div>

                                        <!-- Order Items Preview -->
                                        <div class="p-6">
                                            <div class="flex flex-wrap gap-4">
                                                @foreach($order->items->take(3) as $item)
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                                            @if($item->product && $item->product->primaryImage)
                                                                <img src="{{ asset('storage/' . $item->product->primaryImage->thumbnail_path) }}"
                                                                    alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                                            @else
                                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-heading">
                                                                {{ Str::limit($item->product_name, 25) }}</p>
                                                            <p class="text-xs text-muted">Qty: {{ $item->quantity }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if($order->items->count() > 3)
                                                    <div class="flex items-center">
                                                        <span class="text-sm text-muted">+{{ $order->items->count() - 3 }} more items</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Order Footer -->
                                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                                            <div class="text-sm text-muted">
                                                {{ $order->items->sum('quantity') }}
                                                {{ Str::plural('item', $order->items->sum('quantity')) }}
                                            </div>
                                            <div class="font-bold text-heading">
                                                Total: Rs. {{ number_format($order->total) }}
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-heading font-bold text-heading mb-4">No orders yet</h2>
                    <p class="text-muted mb-8 max-w-md mx-auto">
                        You haven't placed any orders yet. Start exploring our premium coffee collection and find your
                        perfect blend.
                    </p>
                    <a href="{{ route('shop.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-primary text-secondary font-medium rounded-lg hover:bg-primary/90 transition-colors">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

