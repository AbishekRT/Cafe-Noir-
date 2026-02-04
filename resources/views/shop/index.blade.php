{{--
Shop Listing Page
Features: Product grid, Category filter, Search, Sorting, Pagination
--}}
<x-app-layout>
    <x-slot name="title">Shop - Cafe Noir</x-slot>
    <x-slot name="metaDescription">Browse our collection of premium coffee beans, blends, and accessories. Find your
        perfect coffee at Cafe Noir.</x-slot>

    <!-- Page Header -->
    <section class="bg-primary text-white py-12">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-h1 font-bold mb-4">Our Coffee Collection</h1>
            <p class="text-secondary/90 max-w-2xl">
                Discover our carefully curated selection of premium coffee beans from around the world.
            </p>
        </div>
    </section>

    <!-- Shop Content -->
    <section class="py-section">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="lg:w-64 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow-subtle p-6 sticky top-24">
                        <!-- Search -->
                        <div class="mb-6">
                            <h3 class="font-heading text-lg font-semibold text-heading mb-3">Search</h3>
                            <form action="{{ route('shop.index') }}" method="GET">
                                @if($selectedCategory)
                                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                                @endif
                                @if($sort !== 'newest')
                                    <input type="hidden" name="sort" value="{{ $sort }}">
                                @endif
                                <div class="relative">
                                    <input type="text" name="search" value="{{ $searchTerm }}"
                                        placeholder="Search products..."
                                        class="w-full border border-primary/20 rounded-lg py-2 pl-4 pr-10 text-sm focus:ring-accent focus:border-accent">
                                    <button type="submit"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-muted hover:text-accent">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h3 class="font-heading text-lg font-semibold text-heading mb-3">Categories</h3>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('shop.index', array_filter(['search' => $searchTerm, 'sort' => $sort !== 'newest' ? $sort : null])) }}"
                                        class="flex items-center justify-between py-1 text-sm {{ !$selectedCategory ? 'text-accent font-semibold' : 'text-body hover:text-accent' }} transition-colors">
                                        <span>All Products</span>
                                        <span class="text-muted text-xs">({{ $products->total() }})</span>
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('shop.index', array_filter(['category' => $category->slug, 'search' => $searchTerm, 'sort' => $sort !== 'newest' ? $sort : null])) }}"
                                            class="flex items-center justify-between py-1 text-sm {{ $selectedCategory === $category->slug ? 'text-accent font-semibold' : 'text-body hover:text-accent' }} transition-colors">
                                            <span>{{ $category->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Clear Filters -->
                        @if($selectedCategory || $searchTerm)
                            <a href="{{ route('shop.index') }}"
                                class="text-sm text-muted hover:text-accent transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear Filters
                            </a>
                        @endif
                    </div>
                </aside>

                <!-- Products Grid -->
                <div class="flex-grow">
                    <!-- Toolbar -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <p class="text-muted text-sm">
                            Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of
                            {{ $products->total() }} products
                        </p>

                        <!-- Sort -->
                        <div class="flex items-center space-x-2">
                            <label for="sort" class="text-sm text-muted">Sort by:</label>
                            <select id="sort"
                                class="border border-primary/20 rounded-lg py-2 px-3 text-sm focus:ring-accent focus:border-accent"
                                onchange="window.location.href = this.value">
                                <option
                                    value="{{ route('shop.index', array_filter(['category' => $selectedCategory, 'search' => $searchTerm, 'sort' => 'newest'])) }}"
                                    {{ $sort === 'newest' ? 'selected' : '' }}>
                                    Newest
                                </option>
                                <option
                                    value="{{ route('shop.index', array_filter(['category' => $selectedCategory, 'search' => $searchTerm, 'sort' => 'price_asc'])) }}"
                                    {{ $sort === 'price_asc' ? 'selected' : '' }}>
                                    Price: Low to High
                                </option>
                                <option
                                    value="{{ route('shop.index', array_filter(['category' => $selectedCategory, 'search' => $searchTerm, 'sort' => 'price_desc'])) }}"
                                    {{ $sort === 'price_desc' ? 'selected' : '' }}>
                                    Price: High to Low
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Search Result Notice -->
                    @if($searchTerm)
                        <div class="bg-secondary rounded-lg p-4 mb-6">
                            <p class="text-sm text-body">
                                Search results for: <strong class="text-heading">"{{ $searchTerm }}"</strong>
                                <a href="{{ route('shop.index', array_filter(['category' => $selectedCategory, 'sort' => $sort !== 'newest' ? $sort : null])) }}"
                                    class="text-accent hover:underline ml-2">Clear</a>
                            </p>
                        </div>
                    @endif

                    <!-- Products Grid -->
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-10">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-16">
                            <svg class="w-16 h-16 mx-auto text-muted/50 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="font-heading text-xl font-semibold text-heading mb-2">No Products Found</h3>
                            <p class="text-muted mb-4">We couldn't find any products matching your criteria.</p>
                            <x-button href="{{ route('shop.index') }}" variant="primary">
                                View All Products
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
