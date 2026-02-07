{{--
FAQs Page
Features: Accordion-style FAQ sections
--}}
<x-app-layout>
    <x-slot name="title">Frequently Asked Questions - {{ config('cafe.name') }}</x-slot>
    <x-slot name="metaDescription">Find answers to common questions about {{ config('cafe.name') }}'s products,
        shipping, returns, and more.</x-slot>

    <!-- Hero Section -->
    <section class="hero-faq text-white py-16 md:py-20">
        <div class="relative z-10 container mx-auto px-4 text-center">
            <span class="accent-line-center mb-4"></span>
            <h1 class="font-heading font-bold mb-4" style="font-size: clamp(2.5rem, 5vw, 3.5rem); color: #F5EFE6;">
                Frequently Asked Questions</h1>
            <p class="text-xl max-w-2xl mx-auto" style="color: rgba(245,239,230,0.75);">
                Find answers to the most common questions about our products and services.
            </p>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Quick Links -->
            <div class="mb-12 flex flex-wrap justify-center gap-3 reveal">
                <a href="#ordering" class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300"
                    style="background: #F5EFE6; color: #4E342E; box-shadow: 0 2px 8px rgba(78,52,46,0.1);"
                    onmouseover="this.style.background='#4E342E'; this.style.color='#F5EFE6'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(78,52,46,0.2)'"
                    onmouseout="this.style.background='#F5EFE6'; this.style.color='#4E342E'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(78,52,46,0.1)'">
                    Ordering
                </a>
                <a href="#shipping" class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300"
                    style="background: #F5EFE6; color: #4E342E; box-shadow: 0 2px 8px rgba(78,52,46,0.1);"
                    onmouseover="this.style.background='#4E342E'; this.style.color='#F5EFE6'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(78,52,46,0.2)'"
                    onmouseout="this.style.background='#F5EFE6'; this.style.color='#4E342E'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(78,52,46,0.1)'">
                    Shipping
                </a>
                <a href="#products" class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300"
                    style="background: #F5EFE6; color: #4E342E; box-shadow: 0 2px 8px rgba(78,52,46,0.1);"
                    onmouseover="this.style.background='#4E342E'; this.style.color='#F5EFE6'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(78,52,46,0.2)'"
                    onmouseout="this.style.background='#F5EFE6'; this.style.color='#4E342E'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(78,52,46,0.1)'">
                    Products
                </a>
                <a href="#returns" class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300"
                    style="background: #F5EFE6; color: #4E342E; box-shadow: 0 2px 8px rgba(78,52,46,0.1);"
                    onmouseover="this.style.background='#4E342E'; this.style.color='#F5EFE6'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(78,52,46,0.2)'"
                    onmouseout="this.style.background='#F5EFE6'; this.style.color='#4E342E'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(78,52,46,0.1)'">
                    Returns
                </a>
                <a href="#payment" class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300"
                    style="background: #F5EFE6; color: #4E342E; box-shadow: 0 2px 8px rgba(78,52,46,0.1);"
                    onmouseover="this.style.background='#4E342E'; this.style.color='#F5EFE6'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(78,52,46,0.2)'"
                    onmouseout="this.style.background='#F5EFE6'; this.style.color='#4E342E'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(78,52,46,0.1)'">
                    Payment
                </a>
            </div>

            <!-- Ordering FAQs -->
            <div id="ordering" class="mb-12 reveal">
                <h2 class="text-2xl font-heading font-bold text-heading mb-6 flex items-center">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                        style="background: linear-gradient(135deg, #C9A24D, #D4AF61); box-shadow: 0 4px 12px rgba(201,162,77,0.3);">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </span>
                    Ordering
                </h2>
                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">How do I place an order?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Placing an order is easy! Simply browse our shop, add your favorite products to your
                                cart,
                                and proceed to checkout. You can check out as a guest or create an account for a faster
                                checkout experience in the future. We accept both Cash on Delivery and credit card
                                payments.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">Can I modify or cancel my order?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                You can modify or cancel your order within 1 hour of placing it, provided it hasn't been
                                processed for shipping yet. Please contact our customer service team immediately via
                                email
                                or WhatsApp with your order number to make any changes.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">Do I need an account to place an order?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                No, you can checkout as a guest. However, creating an account allows you to track your
                                orders,
                                save your shipping information for faster checkout, and view your order history.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping FAQs -->
            <div id="shipping" class="mb-12 reveal">
                <h2 class="text-2xl font-heading font-bold text-heading mb-6 flex items-center">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                        style="background: linear-gradient(135deg, #C9A24D, #D4AF61); box-shadow: 0 4px 12px rgba(201,162,77,0.3);">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>
                    </span>
                    Shipping
                </h2>
                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">What are the shipping options?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                We offer standard shipping (3-5 business days) and express shipping (1-2 business days).
                                Shipping costs are calculated at checkout based on your location and selected shipping
                                method.
                                Free standard shipping is available for orders over $50.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">How can I track my order?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Once your order ships, you'll receive an email with tracking information. If you have an
                                account,
                                you can also log in to view your order status and tracking details in your order
                                history.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">Do you ship internationally?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Currently, we ship to the United States and Canada. We're working on expanding our
                                shipping
                                options to more countries. Sign up for our newsletter to be notified when we add new
                                shipping destinations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products FAQs -->
            <div id="products" class="mb-12 reveal">
                <h2 class="text-2xl font-heading font-bold text-heading mb-6 flex items-center">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                        style="background: linear-gradient(135deg, #C9A24D, #D4AF61); box-shadow: 0 4px 12px rgba(201,162,77,0.3);">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </span>
                    Products
                </h2>
                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">How fresh is your coffee?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                We roast our coffee in small batches and ship within 24-48 hours of roasting. Each bag
                                includes
                                a roast date so you know exactly how fresh your coffee is. For optimal flavor, we
                                recommend
                                consuming within 4-6 weeks of the roast date.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">What grind options do you offer?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                We offer whole bean, coarse grind (French Press), medium grind (Drip/Pour Over),
                                and fine grind (Espresso). For the freshest taste, we recommend whole bean and grinding
                                just before brewing.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">Are your coffees organic or fair trade?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Many of our coffees are certified organic and/or fair trade. Look for the certification
                                badges
                                on individual product pages. We're committed to ethical sourcing and work directly with
                                farmers
                                to ensure fair compensation.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 4 ? null : 4"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">How should I store my coffee?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 4 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 4" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Store your coffee in a cool, dark place in an airtight container. Avoid storing in the
                                refrigerator
                                or freezer as moisture can affect the flavor. Our bags feature a one-way valve that
                                allows CO2 to
                                escape while keeping air out, perfect for short-term storage.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Returns FAQs -->
            <div id="returns" class="mb-12 reveal">
                <h2 class="text-2xl font-heading font-bold text-heading mb-6 flex items-center">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                        style="background: linear-gradient(135deg, #C9A24D, #D4AF61); box-shadow: 0 4px 12px rgba(201,162,77,0.3);">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z">
                            </path>
                        </svg>
                    </span>
                    Returns & Refunds
                </h2>
                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">What is your return policy?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                We want you to love your coffee! If you're not satisfied with your purchase, contact us
                                within
                                14 days of delivery. For unopened products, we offer a full refund or exchange. For
                                quality issues
                                with opened products, we'll work with you to make it right.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">What if my order arrives damaged?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                If your order arrives damaged, please contact us immediately with photos of the damage.
                                We'll arrange for a replacement or full refund at no additional cost to you.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">How long do refunds take?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Refunds are processed within 3-5 business days after we receive your return or approve
                                your refund request.
                                Depending on your payment method, it may take an additional 5-10 business days for the
                                refund to appear
                                in your account.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment FAQs -->
            <div id="payment" class="mb-12 reveal">
                <h2 class="text-2xl font-heading font-bold text-heading mb-6 flex items-center">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                        style="background: linear-gradient(135deg, #C9A24D, #D4AF61); box-shadow: 0 4px 12px rgba(201,162,77,0.3);">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                    </span>
                    Payment
                </h2>
                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">What payment methods do you accept?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                We accept all major credit cards (Visa, MasterCard, American Express, Discover) through
                                our secure
                                Stripe payment processor. We also offer Cash on Delivery (COD) for customers who prefer
                                to pay when
                                they receive their order.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">Is my payment information secure?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Yes, absolutely! We use Stripe for payment processing, which is PCI-DSS compliant and
                                uses
                                industry-leading encryption. Your credit card information is never stored on our
                                servers.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="rounded-xl overflow-hidden transition-all duration-300" style="border: 1px solid rgba(78,52,46,0.08); box-shadow: 0 2px 8px rgba(78,52,46,0.04);">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between transition-all duration-300" style="background: rgba(245,239,230,0.6);"  onmouseover="this.style.background='rgba(245,239,230,1)'" onmouseout="this.style.background='rgba(245,239,230,0.6)'">
                            <span class="font-medium text-heading">When will my card be charged?</span>
                            <svg class="w-5 h-5 text-primary transform transition-transform"
                                :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-6 py-4 bg-white">
                            <p class="text-body">
                                Your card will be charged immediately when you place your order. For Cash on Delivery
                                orders,
                                you'll pay when the order is delivered to your address.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Still Have Questions -->
    <section class="section-dark py-16">
        <div class="container mx-auto px-4 text-center reveal">
            <span class="accent-line-center mb-4"></span>
            <h2 class="text-2xl font-heading font-bold mb-4" style="color: #F5EFE6;">Still Have Questions?</h2>
            <p class="max-w-xl mx-auto mb-8" style="color: rgba(245,239,230,0.7);">
                Can't find the answer you're looking for? Our customer support team is here to help!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('pages.contact') }}"
                    class="btn-glow inline-flex items-center justify-center px-8 py-3 font-semibold rounded-xl transition-all duration-300"
                    style="background: linear-gradient(135deg, #C9A24D, #D4AF61); color: #2E1F1A;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    Contact Us
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('cafe.contact.whatsapp')) }}"
                    target="_blank" rel="noopener"
                    class="inline-flex items-center justify-center px-8 py-3 font-semibold rounded-xl transition-all duration-300"
                    style="background: linear-gradient(135deg, #25D366, #128C7E); color: #fff; box-shadow: 0 4px 16px rgba(37,211,102,0.3);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(37,211,102,0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(37,211,102,0.3)'">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                        </path>
                    </svg>
                    WhatsApp Us
                </a>
            </div>
        </div>
    </section>

    <!-- Alpine.js Collapse Plugin Fallback -->
    <script>
        // Simple fallback for x-collapse if Alpine Collapse plugin isn't loaded
        document.addEventListener('alpine:init', () => {
            if (!Alpine.directive('collapse')) {
                Alpine.directive('collapse', (el) => {
                    // Simple show/hide as fallback
                });
            }
        });
    </script>
</x-app-layout>
