{{--
Home Page
Features: Hero section, Featured products, Category showcase, Brand story, Testimonials, CTA
--}}
<x-app-layout>
    <x-slot name="title">Cafe Noir - Premium Artisan Coffee</x-slot>
    <x-slot name="metaDescription">Discover the finest artisan coffee at Cafe Noir. Premium beans, expertly roasted for
        the perfect cup every time.</x-slot>

    <!-- Hero Section -->
    <section class="hero-home">
        <div class="relative z-10 max-w-content mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-0">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div>
                        <span class="accent-line mb-4"></span>
                        <h1 class="font-heading font-bold leading-tight text-white"
                            style="font-size: clamp(2.5rem, 5vw, 4rem); line-height: 1.1;">
                            Experience the <span class="text-gradient">Finest</span> Coffee
                        </h1>
                    </div>
                    <p class="text-lg leading-relaxed max-w-lg" style="color: rgba(245,239,230,0.8);">
                        Discover our carefully curated selection of premium artisan coffee beans,
                        sourced from the world's finest coffee-growing regions.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('shop.index') }}"
                            class="btn-glow inline-flex items-center px-8 py-4 rounded-lg font-semibold text-sm tracking-wide transition-all duration-300"
                            style="background: #C9A24D; color: #2E1F1A;">
                            <span>SHOP NOW</span>
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('pages.about') }}"
                            class="inline-flex items-center px-8 py-4 rounded-lg font-semibold text-sm tracking-wide transition-all duration-300"
                            style="background: rgba(255,255,255,0.1); color: #F5EFE6; border: 1px solid rgba(245,239,230,0.2); backdrop-filter: blur(10px);"
                            onmouseover="this.style.background='rgba(255,255,255,0.2)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                            OUR STORY
                        </a>
                    </div>
                    <!-- Trust Badges -->
                    <div class="flex items-center space-x-6 pt-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" style="color: #C9A24D;" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <span class="text-xs font-medium" style="color: rgba(245,239,230,0.6);">4.9/5 Rating</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" style="color: #C9A24D;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-xs font-medium" style="color: rgba(245,239,230,0.6);">Free Shipping</span>
                        </div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <svg class="w-5 h-5" style="color: #C9A24D;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="text-xs font-medium" style="color: rgba(245,239,230,0.6);">Secure
                                Checkout</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex justify-center items-center">
                    <div class="relative">
                        <div class="w-72 h-72 lg:w-80 lg:h-80 rounded-full overflow-hidden animate-float"
                            style="box-shadow: 0 25px 60px rgba(0,0,0,0.3);">
                            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&h=600&fit=crop"
                                alt="Premium Coffee" class="w-full h-full object-cover">
                        </div>
                        <!-- Floating badge -->
                        <div class="absolute -bottom-4 -left-4 px-5 py-3 rounded-lg"
                            style="background: rgba(46,31,26,0.95); backdrop-filter: blur(10px); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                            <div class="font-heading text-xl font-bold text-accent">50+</div>
                            <div class="text-xs" style="color: rgba(245,239,230,0.7);">Varieties</div>
                        </div>
                        <div class="absolute -top-4 -right-4 px-5 py-3 rounded-lg"
                            style="background: rgba(46,31,26,0.95); backdrop-filter: blur(10px); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                            <div class="font-heading text-xl font-bold text-accent">10K+</div>
                            <div class="text-xs" style="color: rgba(245,239,230,0.7);">Customers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-section section-cream">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <span class="accent-line-center mb-4"></span>
                <h2 class="font-heading text-h2 font-bold text-heading mb-4">Featured Products</h2>
                <p class="text-muted max-w-2xl mx-auto">
                    Explore our handpicked selection of premium coffee beans, roasted to perfection.
                </p>
            </div>

            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $index => $product)
                        <div class="reveal delay-{{ ($index % 4) + 1 }}">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12 reveal">
                    <a href="{{ route('shop.index') }}"
                        class="btn-glow inline-flex items-center px-8 py-4 rounded-lg font-semibold transition-all duration-300"
                        style="background: #4E342E; color: white;">
                        View All Products
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
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
                <div class="text-center mb-12 reveal">
                    <span class="accent-line-center mb-4"></span>
                    <h2 class="font-heading text-h2 font-bold text-heading mb-4">Shop by Category</h2>
                    <p class="text-muted max-w-2xl mx-auto">
                        Find your perfect coffee match from our diverse selection of categories.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($categories as $index => $category)
                        <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                            class="category-card group bg-secondary rounded-xl p-6 text-center reveal delay-{{ ($index % 4) + 1 }}">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110"
                                style="background: rgba(78,52,46,0.08);">
                                <svg class="w-8 h-8 text-primary group-hover:text-accent transition-colors duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3
                                class="font-heading text-lg font-semibold text-heading group-hover:text-accent transition-colors duration-300">
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
    <section class="py-section section-warm">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="reveal-left">
                    <span class="accent-line mb-4"></span>
                    <h2 class="font-heading text-h2 font-bold text-heading mb-6">
                        The Cafe Noir Story
                    </h2>
                    <div class="space-y-4 text-body leading-relaxed">
                        <p>
                            Founded with a passion for exceptional coffee, Cafe Noir has been on a mission
                            to bring the world's finest beans to your cup since 2015.
                        </p>
                        <p>
                            Our journey begins at the source — partnering directly with small-scale farmers
                            across Colombia, Ethiopia, Brazil, and beyond. We believe in fair trade practices
                            and sustainable farming that respects both people and planet.
                        </p>
                        <p>
                            Every batch is roasted in small quantities to ensure peak freshness and flavor.
                            From the first sip to the last, experience the difference that true craftsmanship makes.
                        </p>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('pages.about') }}"
                            class="inline-flex items-center text-accent font-semibold group">
                            Learn More About Us
                            <svg class="ml-2 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="reveal-right">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="counter-box bg-white rounded-xl p-6 text-center shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">10+</div>
                            <div class="text-sm text-muted mt-1">Years Experience</div>
                        </div>
                        <div class="counter-box bg-white rounded-xl p-6 text-center shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">50+</div>
                            <div class="text-sm text-muted mt-1">Coffee Varieties</div>
                        </div>
                        <div class="counter-box bg-white rounded-xl p-6 text-center shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">20+</div>
                            <div class="text-sm text-muted mt-1">Countries Sourced</div>
                        </div>
                        <div class="counter-box bg-white rounded-xl p-6 text-center shadow-subtle">
                            <div class="font-heading text-3xl font-bold text-accent">10K+</div>
                            <div class="text-sm text-muted mt-1">Happy Customers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-section bg-white">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <span class="accent-line-center mb-4"></span>
                <h2 class="font-heading text-h2 font-bold text-heading mb-4">What Our Customers Say</h2>
                <p class="text-muted max-w-2xl mx-auto">Join thousands of satisfied coffee lovers.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        ['name' => 'Sarah M.', 'text' => 'The Ethiopian Yirgacheffe is absolutely divine. Best coffee I\'ve ever had delivered to my door. The aroma alone is worth it!', 'rating' => 5],
                        ['name' => 'James K.', 'text' => 'Outstanding quality and fast shipping. I\'ve tried many online coffee shops, but Cafe Noir is in a league of its own.', 'rating' => 5],
                        ['name' => 'Priya D.', 'text' => 'From ordering to brewing, the experience is perfect. The Colombian blend has become my daily ritual. Highly recommend!', 'rating' => 5],
                    ];
                @endphp
                @foreach($testimonials as $i => $testimonial)
                    <div class="testimonial-card bg-secondary rounded-xl p-8 reveal delay-{{ $i + 1 }}">
                        <div class="flex space-x-1 mb-4">
                            @for($s = 0; $s < $testimonial['rating']; $s++)
                                <svg class="w-4 h-4 star-gold" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-body leading-relaxed mb-6" style="font-style: italic;">
                            "{{ $testimonial['text'] }}"
                        </p>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-heading font-bold text-white text-sm"
                                style="background: #4E342E;">
                                {{ substr($testimonial['name'], 0, 1) }}
                            </div>
                            <span class="font-heading font-semibold text-heading text-sm">{{ $testimonial['name'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-dark py-section">
        <div class="max-w-content mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
            <span class="accent-line-center mb-6"></span>
            <h2 class="font-heading font-bold mb-4" style="font-size: clamp(1.75rem, 3.5vw, 2.5rem); color: #F5EFE6;">
                Ready to Experience Premium Coffee?
            </h2>
            <p class="max-w-2xl mx-auto mb-10" style="color: rgba(245,239,230,0.7);">
                Join thousands of coffee lovers who have discovered the Cafe Noir difference.
                Start your journey to exceptional coffee today.
            </p>
            <a href="{{ route('shop.index') }}"
                class="btn-glow inline-flex items-center px-10 py-4 rounded-lg font-semibold text-sm tracking-wide transition-all duration-300"
                style="background: #C9A24D; color: #2E1F1A;">
                BROWSE OUR COLLECTION
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </section>
</x-app-layout>