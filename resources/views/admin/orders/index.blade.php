{{-- 
    Admin Orders List
    Features: Order listing with status filters
--}}
<x-app-layout>
    <x-slot name="title">Orders - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <nav class="text-secondary/60 text-sm mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-secondary">Orders</span>
                </nav>
                <h1 class="text-2xl font-heading font-bold text-secondary">Orders</h1>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Status Filters -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('status') ? 'bg-primary text-secondary' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All Orders
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                        Pending
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'processing' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">
                        Processing
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'shipped' ? 'bg-purple-500 text-white' : 'bg-purple-100 text-purple-800 hover:bg-purple-200' }}">
                        Shipped
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'delivered' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                        Delivered
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('status') === 'cancelled' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                        Cancelled
                    </a>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Orders Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Items</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Payment</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-muted uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="font-medium text-accent hover:underline">
                                            #{{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-heading">{{ $order->customer_name }}</div>
                                        <div class="text-sm text-muted">{{ $order->customer_email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-body">
                                        {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-heading">Rs. {{ number_format($order->total) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $order->payment_method === 'cod' ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $order->payment_method === 'cod' ? 'COD' : 'Card' }}
                                        </span>
                                        @if($order->payment_status === 'paid')
                                            <span class="ml-1 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                Paid
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'shipped' => 'bg-purple-100 text-purple-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted">
                                        {{ $order->created_at->format('M d, Y') }}
                                        <div class="text-xs">{{ $order->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-accent hover:text-accent/80 font-medium text-sm">
                                            View Details →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <p class="text-muted">No orders found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $orders->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

