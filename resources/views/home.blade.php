{{--
Home Page
Features: Hero section, Featured products, Category showcase, Brand story
--}}
<x-app-layout>
    <x-slot name="title">Cafe Noir - Premium Artisan Coffee</x-slot>
    <x-slot name="metaDescription">Discover the finest artisan coffee at Cafe Noir. Premium beans, expertly roasted for
        the perfect cup every time.</x-slot>

    <!-- Hero Section -->
    <section class="relative bg-primary text-white py-16 md:py-24">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <h1 class="font-heading text-h1 font-bold leading-tight">
                        Experience the <span class="text-accent">Finest</span> Coffee
                    </h1>
                    <p class="text-lg text-secondary/90 leading-relaxed max-w-lg">
                        Discover our carefully curated selection of premium artisan coffee beans,
                        sourced from the world's finest coffee-growing regions.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <x-button href="{{ route('shop.index') }}" variant="accent" size="lg">
                            Shop Now
                        </x-button>
                        <x-button href="{{ route('pages.about') }}" variant="secondary" size="lg">
                            Our Story
                        </x-button>
                    </div>
                </div>
                <div class="hidden md:flex justify-center">
                    <svg class="w-80 h-80" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="100" r="90" fill="#C9A24D" opacity="0.2" />
                        <circle cx="100" cy="100" r="70" fill="#C9A24D" opacity="0.3" />
                        <ellipse cx="100" cy="110" rx="45" ry="35" fill="#F5EFE6" />
                        <path d="M55 90C55 90 65 70 100 70C135 70 145 90 145 90" stroke="#F5EFE6" stroke-width="4"
                            stroke-linecap="round" />
                        <path d="M145 100C155 100 165 90 165 80C165 70 155 60 145 60" stroke="#F5EFE6" stroke-width="4"
                            stroke-linecap="round" />
                        <ellipse cx="100" cy="100" rx="20" ry="10" fill="#C9A24D" />
                        <path d="M75 140L65 170M125 140L135 170M100 145V175" stroke="#F5EFE6" stroke-width="4"
                            stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-section">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-h2 font-bold text-heading mb-4">Featured Products</h2>
                <p class="text-muted max-w-2xl mx-auto">
                    Explore our handpicked selection of premium coffee beans, roasted to perfection.
                </p>
            </div>

            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="text-center mt-10">
                    <x-button href="{{ route('shop.index') }}" variant="primary">
                        View All Products
                    </x-button>
                </div>
            @else
                <p class="text-center text-muted py-12">No featured products available at the moment.</p>
            @endif
        </div>
    </section>

    <!-- Categories Section -->
    @if($categories->count() > 0)
        <section class="py-section bg-white">
            <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="font-heading text-h2 font-bold text-heading mb-4">Shop by Category</h2>
                    <p class="text-muted max-w-2xl mx-auto">
                        Find your perfect coffee match from our diverse selection of categories.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                            class="group bg-secondary rounded-lg p-6 text-center hover:shadow-card transition-all">
                            <div
                                class="w-16 h-16 mx-auto mb-4 bg-primary/10 rounded-full flex items-center justify-center group-hover:bg-accent/20 transition-colors">
                                <svg class="w-8 h-8 text-primary group-hover:text-accent transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3
                                class="font-heading text-lg font-semibold text-heading group-hover:text-accent transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-muted mt-1">
                                {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Brand Story Section -->
    <section class="py-section">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-heading text-h2 font-bold text-heading mb-6">
                        The Cafe Noir Story
                    </h2>
                    <div class="space-y-4 text-body leading-relaxed">
                        <p>
                            Founded with a passion for exceptional coffee, Cafe Noir has been on a mission
                            to bring the world's finest beans to your cup since 2015.
                        </p>
                        <p>
                            Our journey begins at the source – partnering directly with small-scale farmers
                            across Colombia, Ethiopia, Brazil, and beyond. We believe in fair trade practices
                            and sustainable farming that respects both people and planet.
                        </p>
                        <p>
                            Every batch is roasted in small quantities to ensure peak freshness and flavor.
                            From the first sip to the last, experience the difference that true craftsmanship makes.
                        </p>
                    </div>
                    <div class="mt-8">
                        <x-button href="{{ route('pages.about') }}" variant="secondary">
                            Learn More About Us
                        </x-button>
                    </div>
                </div>
                <div class="bg-primary/5 rounded-lg p-8 md:p-12">
                    <div class="grid grid-cols-2 gap-6 text-center">
                        <div class="bg-white rounded-lg p-6 shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">10+</div>
                            <div class="text-sm text-muted mt-1">Years Experience</div>
                        </div>
                        <div class="bg-white rounded-lg p-6 shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">50+</div>
                            <div class="text-sm text-muted mt-1">Coffee Varieties</div>
                        </div>
                        <div class="bg-white rounded-lg p-6 shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">20+</div>
                            <div class="text-sm text-muted mt-1">Countries Sourced</div>
                        </div>
                        <div class="bg-white rounded-lg p-6 shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">10K+</div>
                            <div class="text-sm text-muted mt-1">Happy Customers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-section bg-primary text-white">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-h2 font-bold mb-4">
                Ready to Experience Premium Coffee?
            </h2>
            <p class="text-secondary/90 max-w-2xl mx-auto mb-8">
                Join thousands of coffee lovers who have discovered the Cafe Noir difference.
                Start your journey to exceptional coffee today.
            </p>
            <x-button href="{{ route('shop.index') }}" variant="accent" size="lg">
                Browse Our Collection
            </x-button>
        </div>
    </section>
</x-app-layout>
