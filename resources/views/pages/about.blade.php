{{--
About Us Page
Features: Story, Mission, Values, Team section
--}}
<x-app-layout>
    <x-slot name="title">About Us - {{ config('cafe.name') }}</x-slot>
    <x-slot name="metaDescription">Learn about {{ config('cafe.name') }}'s journey, our passion for exceptional coffee,
        and our commitment to quality and sustainability.</x-slot>

    <!-- Hero Section -->
    <section class="hero-about">
        <div class="relative z-10 w-full">
            <div class="container mx-auto px-4 text-center py-20">
                <span class="accent-line-center mb-4"></span>
                <h1 class="font-heading font-bold mb-4" style="font-size: clamp(2.5rem, 5vw, 3.5rem); color: #F5EFE6;">
                    Our Story</h1>
                <p class="text-xl max-w-2xl mx-auto" style="color: rgba(245,239,230,0.75);">
                    A passion for exceptional coffee, rooted in tradition and crafted with love.
                </p>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal-left">
                    <span class="accent-line mb-4"></span>
                    <h2 class="text-3xl font-heading font-bold text-heading mb-6">The Beginning</h2>
                    <div class="space-y-4 text-body">
                        <p>
                            {{ config('cafe.name') }} was born from a simple belief: that every cup of coffee should
                            be an experience worth savoring. Founded in 2018 by a group of coffee enthusiasts, we
                            set out to bring the world's finest beans directly to your cup.
                        </p>
                        <p>
                            Our journey began with a small roastery and a dream to share our passion for exceptional
                            coffee. Today, we source premium beans from the most renowned coffee-growing regions,
                            working directly with farmers who share our commitment to quality and sustainability.
                        </p>
                        <p>
                            Every batch is carefully roasted to perfection, ensuring that each cup delivers the rich,
                            complex flavors that coffee lovers deserve. From bean to brew, we oversee every step of
                            the process with meticulous care.
                        </p>
                    </div>
                </div>
                <div class="relative reveal-right">
                    <div class="aspect-square bg-secondary rounded-xl overflow-hidden image-zoom"
                        style="box-shadow: 0 20px 50px rgba(78,52,46,0.15);">
                        <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&h=600&fit=crop"
                            alt="Coffee roasting process" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 rounded-xl"
                        style="background: linear-gradient(135deg, #C9A24D, #D4B060);"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-16 section-warm">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 reveal">
                <span class="accent-line-center mb-4"></span>
                <h2 class="text-3xl font-heading font-bold text-heading mb-4">Our Mission & Values</h2>
                <p class="text-body max-w-2xl mx-auto">
                    We're driven by a commitment to excellence in every aspect of what we do.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Quality -->
                <div class="bg-white rounded-xl p-8 text-center reveal delay-1"
                    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background: #4E342E;">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-heading mb-3">Uncompromising Quality</h3>
                    <p class="text-body">
                        We source only the top 3% of the world's coffee beans, ensuring every cup meets our
                        exacting standards for flavor and aroma.
                    </p>
                </div>

                <!-- Sustainability -->
                <div class="bg-white rounded-xl p-8 text-center reveal delay-2"
                    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background: #4E342E;">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-heading mb-3">Sustainable Practices</h3>
                    <p class="text-body">
                        From eco-friendly packaging to fair trade partnerships, we're committed to protecting
                        our planet and supporting coffee-growing communities.
                    </p>
                </div>

                <!-- Community -->
                <div class="bg-white rounded-xl p-8 text-center reveal delay-3"
                    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background: #4E342E;">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-heading mb-3">Community First</h3>
                    <p class="text-body">
                        We believe in building lasting relationships with our customers, farmers, and partners,
                        creating a community united by a love of great coffee.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Coffee Journey -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 reveal">
                <span class="accent-line-center mb-4"></span>
                <h2 class="text-3xl font-heading font-bold text-heading mb-4">From Bean to Cup</h2>
                <p class="text-body max-w-2xl mx-auto">
                    Every step of our process is designed to deliver the perfect coffee experience.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="process-step text-center reveal delay-1">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"
                        style="background: linear-gradient(135deg, #C9A24D, #D4B060); box-shadow: 0 8px 20px rgba(201,162,77,0.3);">
                        <span class="text-2xl font-heading font-bold text-primary">1</span>
                    </div>
                    <h3 class="text-lg font-heading font-semibold text-heading mb-2">Sourcing</h3>
                    <p class="text-body text-sm">
                        We partner with farmers in Ethiopia, Colombia, Brazil, and beyond to source the finest beans.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="process-step text-center reveal delay-2">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"
                        style="background: linear-gradient(135deg, #C9A24D, #D4B060); box-shadow: 0 8px 20px rgba(201,162,77,0.3);">
                        <span class="text-2xl font-heading font-bold text-primary">2</span>
                    </div>
                    <h3 class="text-lg font-heading font-semibold text-heading mb-2">Roasting</h3>
                    <p class="text-body text-sm">
                        Small-batch roasting ensures optimal flavor development and freshness for every order.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="process-step text-center reveal delay-3">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"
                        style="background: linear-gradient(135deg, #C9A24D, #D4B060); box-shadow: 0 8px 20px rgba(201,162,77,0.3);">
                        <span class="text-2xl font-heading font-bold text-primary">3</span>
                    </div>
                    <h3 class="text-lg font-heading font-semibold text-heading mb-2">Packaging</h3>
                    <p class="text-body text-sm">
                        Sealed within hours of roasting to preserve the rich aromas and complex flavors.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="process-step text-center reveal delay-4">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"
                        style="background: linear-gradient(135deg, #C9A24D, #D4B060); box-shadow: 0 8px 20px rgba(201,162,77,0.3);">
                        <span class="text-2xl font-heading font-bold text-primary">4</span>
                    </div>
                    <h3 class="text-lg font-heading font-semibold text-heading mb-2">Delivery</h3>
                    <p class="text-body text-sm">
                        Shipped directly to your door, ensuring you receive the freshest coffee possible.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 section-warm">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 reveal">
                <span class="accent-line-center mb-4"></span>
                <h2 class="text-3xl font-heading font-bold text-heading mb-4">Meet Our Team</h2>
                <p class="text-body max-w-2xl mx-auto">
                    The passionate individuals behind every perfect cup.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl overflow-hidden reveal delay-1"
                    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
                    <div class="aspect-square image-zoom">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop"
                            alt="Marcus Chen - Founder" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-heading font-semibold text-heading">Marcus Chen</h3>
                        <p class="text-accent font-medium text-sm mb-2">Founder & Head Roaster</p>
                        <p class="text-body text-sm">
                            With 15 years of experience, Marcus brings expertise and passion to every roast.
                        </p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl overflow-hidden reveal delay-2"
                    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
                    <div class="aspect-square image-zoom">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop"
                            alt="Sarah Williams - Operations Manager" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-heading font-semibold text-heading">Sarah Williams</h3>
                        <p class="text-accent font-medium text-sm mb-2">Operations Manager</p>
                        <p class="text-body text-sm">
                            Sarah ensures every order is handled with care and delivered on time.
                        </p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl overflow-hidden reveal delay-3"
                    style="box-shadow: 0 2px 12px rgba(78,52,46,0.06);">
                    <div class="aspect-square image-zoom">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop"
                            alt="David Okonkwo - Head of Sourcing" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-heading font-semibold text-heading">David Okonkwo</h3>
                        <p class="text-accent font-medium text-sm mb-2">Head of Sourcing</p>
                        <p class="text-body text-sm">
                            David travels the world to build relationships with the best coffee farmers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-dark py-16">
        <div class="container mx-auto px-4 text-center reveal">
            <h2 class="text-3xl font-heading font-bold mb-4" style="color: #F5EFE6;">Ready to Experience the Difference?
            </h2>
            <p class="max-w-2xl mx-auto mb-8" style="color: rgba(245,239,230,0.7);">
                Join thousands of coffee lovers who have discovered the {{ config('cafe.name') }} difference.
                Browse our collection and find your perfect roast.
            </p>
            <a href="{{ route('shop.index') }}"
                class="btn-glow inline-flex items-center px-8 py-4 rounded-lg font-semibold transition-all duration-300"
                style="background: #C9A24D; color: #2E1F1A;">
                Shop Our Collection
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </section>
</x-app-layout>