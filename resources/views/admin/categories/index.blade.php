{{--
Admin Categories List
Features: Category listing with product counts
--}}
<x-app-layout>
    <x-slot name="title">Categories - Admin - {{ config('cafe.name') }}</x-slot>

    <div class="min-h-screen bg-gray-100">
        <!-- Admin Header -->
        <div class="bg-primary shadow">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <nav class="text-secondary/60 text-sm mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary">Dashboard</a>
                            <span class="mx-2">/</span>
                            <span class="text-secondary">Categories</span>
                        </nav>
                        <h1 class="text-2xl font-heading font-bold text-secondary">Categories</h1>
                    </div>
                    <a href="{{ route('admin.categories.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-accent text-primary text-sm font-medium rounded-lg hover:bg-accent/90 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Add Category
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

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <!-- Category Image -->
                        <div class="aspect-video bg-gray-100 relative">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            @if(!$category->is_active)
                                <div class="absolute top-2 right-2">
                                    <span class="px-2 py-1 bg-gray-800/80 text-white text-xs font-medium rounded">
                                        Inactive
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Category Info -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-lg font-heading font-semibold text-heading">{{ $category->name }}</h3>
                                <span class="px-2 py-1 bg-secondary text-primary text-xs font-medium rounded">
                                    {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                                </span>
                            </div>

                            @if($category->description)
                                <p class="text-sm text-muted mb-4 line-clamp-2">{{ $category->description }}</p>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" target="_blank"
                                    class="text-sm text-accent hover:text-accent/80">
                                    View in Store →
                                </a>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="p-2 text-gray-500 hover:text-accent rounded-lg hover:bg-gray-100"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    @if($category->products_count === 0)
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-gray-100"
                                                title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-2 text-gray-300 cursor-not-allowed"
                                            title="Cannot delete category with products">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        <p class="text-muted mb-4">No categories found.</p>
                        <a href="{{ route('admin.categories.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-accent text-primary text-sm font-medium rounded-lg hover:bg-accent/90 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Add your first category
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="mt-8">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

