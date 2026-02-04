{{--
Cafe Noir Header Component
Includes: Logo, Navigation, Developer Credit, Cart Icon
--}}
<header class="bg-primary shadow-md sticky top-0 z-40">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <!-- SVG Logo -->
                <svg class="h-10 w-10 md:h-12 md:w-12" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="22" fill="#C9A24D" stroke="#F5EFE6" stroke-width="2" />
                    <path d="M14 18C14 18 16 14 24 14C32 14 34 18 34 18" stroke="#2E1F1A" stroke-width="2"
                        stroke-linecap="round" />
                    <ellipse cx="24" cy="26" rx="10" ry="8" fill="#2E1F1A" />
                    <path d="M34 26C36 26 38 24 38 22C38 20 36 18 34 18" stroke="#2E1F1A" stroke-width="2"
                        stroke-linecap="round" />
                    <path d="M18 32L16 38M30 32L32 38M24 34V40" stroke="#2E1F1A" stroke-width="2"
                        stroke-linecap="round" />
                    <ellipse cx="24" cy="23" rx="4" ry="2" fill="#C9A24D" />
                </svg>
                <div>
                    <span class="font-heading text-xl md:text-2xl font-bold text-white tracking-wide">Cafe Noir</span>
                    <span class="hidden md:block text-xs text-accent">Premium Coffee</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="text-white hover:text-accent transition-colors font-medium {{ request()->routeIs('home') ? 'text-accent' : '' }}">
                    Home
                </a>
                <a href="{{ route('shop.index') }}"
                    class="text-white hover:text-accent transition-colors font-medium {{ request()->routeIs('shop.*') ? 'text-accent' : '' }}">
                    Shop
                </a>
                <a href="{{ route('pages.about') }}"
                    class="text-white hover:text-accent transition-colors font-medium {{ request()->routeIs('about') ? 'text-accent' : '' }}">
                    About Us
                </a>
                <a href="{{ route('pages.contact') }}"
                    class="text-white hover:text-accent transition-colors font-medium {{ request()->routeIs('contact') ? 'text-accent' : '' }}">
                    Contact
                </a>
                <a href="{{ route('pages.faqs') }}"
                    class="text-white hover:text-accent transition-colors font-medium {{ request()->routeIs('faqs') ? 'text-accent' : '' }}">
                    FAQs
                </a>
            </nav>

            <!-- Right Side: Cart & Developer Credit -->
            <div class="flex items-center space-x-4 md:space-x-6">
                <!-- Developer Credit -->
                <span class="hidden lg:block text-xs text-secondary/80 border-l border-white/20 pl-4">
                    Developed by <span class="text-accent font-semibold">Nexora Solutions</span>
                </span>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative text-white hover:text-accent transition-colors p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    @php
                        $cartService = app(\App\Services\CartService::class);
                        $cartCount = $cartService->totalQuantity();
                    @endphp
                    @if($cartCount > 0)
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-accent text-heading text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="hidden md:inline-flex text-white hover:text-accent transition-colors text-sm font-medium">
                            Admin
                        </a>
                    @endif
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-white hover:text-accent p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Developer Credit -->
        <div class="md:hidden pb-2 text-center">
            <span class="text-xs text-secondary/70">
                Developed by <span class="text-accent font-semibold">Nexora Solutions</span>
            </span>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-primary border-t border-white/10">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}"
                class="block py-2 text-white hover:text-accent transition-colors {{ request()->routeIs('home') ? 'text-accent' : '' }}">
                Home
            </a>
            <a href="{{ route('shop.index') }}"
                class="block py-2 text-white hover:text-accent transition-colors {{ request()->routeIs('shop.*') ? 'text-accent' : '' }}">
                Shop
            </a>
            <a href="{{ route('pages.about') }}"
                class="block py-2 text-white hover:text-accent transition-colors {{ request()->routeIs('about') ? 'text-accent' : '' }}">
                About Us
            </a>
            <a href="{{ route('pages.contact') }}"
                class="block py-2 text-white hover:text-accent transition-colors {{ request()->routeIs('contact') ? 'text-accent' : '' }}">
                Contact
            </a>
            <a href="{{ route('pages.faqs') }}"
                class="block py-2 text-white hover:text-accent transition-colors {{ request()->routeIs('faqs') ? 'text-accent' : '' }}">
                FAQs
            </a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2 text-accent hover:text-white transition-colors font-medium">
                        Admin Panel
                    </a>
                @endif
            @endauth
        </div>
    </div>
</header>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

