{{-- 
    Admin Dashboard
    Features: Stats overview, Recent orders, Quick actions
--}}
<x-app-layout>
    <x-slot name="title">Admin Dashboard - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-heading font-bold text-secondary">Admin Dashboard</h1>
                        <p class="text-secondary/70 text-sm mt-1">Welcome back, {{ auth()->user()->name }}</p>
                    </div>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-accent text-primary text-sm font-medium rounded-lg hover:bg-accent/90 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View Store
                    </a>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Revenue -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-muted font-medium">Total Revenue</p>
                            <p class="text-2xl font-bold text-heading mt-1">Rs. {{ number_format($1) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-muted mt-2">From {{ $stats['totalOrders'] }} orders</p>
                </div>

                <!-- Total Orders -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-muted font-medium">Total Orders</p>
                            <p class="text-2xl font-bold text-heading mt-1">{{ $stats['totalOrders'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-muted mt-2">{{ $stats['pendingOrders'] }} pending</p>
                </div>

                <!-- Total Products -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-muted font-medium">Total Products</p>
                            <p class="text-2xl font-bold text-heading mt-1">{{ $stats['totalProducts'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-muted mt-2">In {{ $stats['totalCategories'] }} categories</p>
                </div>

                <!-- Total Customers -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-muted font-medium">Total Customers</p>
                            <p class="text-2xl font-bold text-heading mt-1">{{ $stats['totalCustomers'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-muted mt-2">Registered users</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Orders -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-lg font-heading font-semibold text-heading">Recent Orders</h2>
                        <a href="{{ route('admin.orders.index') }}" class="text-sm text-accent hover:text-accent/80 font-medium">
                            View All →
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-muted uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($recentOrders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-accent hover:underline font-medium">
                                                #{{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-body">
                                            {{ $order->customer_name }}
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-heading">
                                            Rs. {{ number_format($order->total) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted">
                                            {{ $order->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-muted">
                                            No orders yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions & Unread Messages -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Quick Actions</h2>
                        <div class="space-y-3">
                            <a href="{{ route('admin.products.create') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-10 h-10 bg-accent rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-heading">Add Product</p>
                                    <p class="text-xs text-muted">Create a new product</p>
                                </div>
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-heading">Add Category</p>
                                    <p class="text-xs text-muted">Create a new category</p>
                                </div>
                            </a>
                            <a href="{{ route('admin.orders.index') }}?status=pending" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-heading">Pending Orders</p>
                                    <p class="text-xs text-muted">{{ $stats['pendingOrders'] }} orders need attention</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Unread Messages -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-heading font-semibold text-heading">Unread Messages</h2>
                            @if($stats['unreadContacts'] > 0)
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                    {{ $stats['unreadContacts'] }} new
                                </span>
                            @endif
                        </div>
                        @if($stats['unreadContacts'] > 0)
                            <p class="text-body text-sm mb-4">
                                You have {{ $stats['unreadContacts'] }} unread contact {{ Str::plural('message', $stats['unreadContacts']) }}.
                            </p>
                            <a href="{{ route('admin.contacts.index') }}?status=unread" class="inline-flex items-center text-accent hover:text-accent/80 text-sm font-medium">
                                View Messages
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <p class="text-muted text-sm">No unread messages.</p>
                        @endif
                    </div>

                    <!-- Low Stock Alert -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-heading font-semibold text-heading mb-4">Low Stock Alert</h2>
                        @if($lowStockProducts->count() > 0)
                            <div class="space-y-3">
                                @foreach($lowStockProducts as $product)
                                    <div class="flex items-center justify-between p-2 bg-red-50 rounded-lg">
                                        <span class="text-sm text-heading truncate">{{ $product->name }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                            {{ $product->stock_quantity }} left
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('admin.products.index') }}?low_stock=1" class="inline-flex items-center text-accent hover:text-accent/80 text-sm font-medium mt-4">
                                View All Low Stock
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <p class="text-muted text-sm">All products are well stocked!</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Admin Navigation -->
            <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.products.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow text-center">
                    <svg class="w-10 h-10 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="font-medium text-heading">Products</h3>
                    <p class="text-sm text-muted">Manage inventory</p>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow text-center">
                    <svg class="w-10 h-10 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <h3 class="font-medium text-heading">Categories</h3>
                    <p class="text-sm text-muted">Organize products</p>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow text-center">
                    <svg class="w-10 h-10 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <h3 class="font-medium text-heading">Orders</h3>
                    <p class="text-sm text-muted">Process orders</p>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow text-center">
                    <svg class="w-10 h-10 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="font-medium text-heading">Messages</h3>
                    <p class="text-sm text-muted">Contact inquiries</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

