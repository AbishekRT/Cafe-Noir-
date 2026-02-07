{{--
Cafe Noir Header Component
Includes: Logo, Navigation, Developer Credit, Cart Icon
--}}
<header x-data="{ mobileMenuOpen: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled ? 'header-scrolled' : ''" class="header-glass sticky top-0 z-40">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <!-- SVG Logo -->
                <svg class="h-10 w-10 md:h-12 md:w-12 transition-transform duration-300 group-hover:scale-110"
                    viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <span class="hidden md:block text-xs text-accent tracking-wider"
                        style="letter-spacing: 0.15em;">PREMIUM COFFEE</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-1">
                @php
                    $navItems = [
                        ['route' => 'home', 'label' => 'Home', 'check' => 'home'],
                        ['route' => 'shop.index', 'label' => 'Shop', 'check' => 'shop.*'],
                        ['route' => 'pages.about', 'label' => 'About', 'check' => 'about'],
                        ['route' => 'pages.contact', 'label' => 'Contact', 'check' => 'contact'],
                        ['route' => 'pages.faqs', 'label' => 'FAQs', 'check' => 'faqs'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs($item['check']) ? 'text-accent' : 'text-white/90 hover:text-white' }}"
                        style="{{ request()->routeIs($item['check']) ? '' : '' }}">
                        {{ $item['label'] }}
                        @if(request()->routeIs($item['check']))
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-5 h-0.5 rounded-full"
                                style="background: #C9A24D;"></span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- Right Side: Cart & Developer Credit -->
            <div class="flex items-center space-x-3 md:space-x-5">
                <!-- Developer Credit -->
                <span class="hidden lg:block text-xs border-l pl-4"
                    style="color: rgba(245,239,230,0.6); border-color: rgba(255,255,255,0.15);">
                    by <span class="text-accent font-semibold">Nexora Solutions</span>
                </span>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}"
                    class="relative text-white hover:text-accent transition-colors p-2 group">
                    <svg class="w-6 h-6 transition-transform duration-200 group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
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
                            class="absolute -top-1 -right-1 bg-accent text-heading text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                            style="box-shadow: 0 2px 8px rgba(201,162,77,0.4);">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="hidden md:inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-full transition-colors duration-200"
                            style="background: rgba(201,162,77,0.15); color: #C9A24D; border: 1px solid rgba(201,162,77,0.3);">
                            Admin
                        </a>
                    @endif
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden text-white hover:text-accent p-2 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" x-cloak @click="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 md:hidden"
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
    </div>

    <!-- Mobile Menu Panel -->
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 bottom-0 z-50 w-72 md:hidden"
        style="background: linear-gradient(180deg, #3E2723 0%, #2E1F1A 100%);">

        <div class="flex flex-col h-full">
            <!-- Close Button -->
            <div class="flex justify-between items-center p-5" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <span class="font-heading text-lg font-bold text-white">Menu</span>
                <button @click="mobileMenuOpen = false" class="text-white/70 hover:text-white p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 py-4 px-5 space-y-1">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center py-3 px-4 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs($item['check']) ? 'text-accent' : 'text-white/80 hover:text-white' }}"
                        style="{{ request()->routeIs($item['check']) ? 'background: rgba(201,162,77,0.1);' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center py-3 px-4 rounded-lg text-sm font-medium text-accent hover:text-white transition-colors duration-200"
                            style="background: rgba(201,162,77,0.1);">
                            Admin Panel
                        </a>
                    @endif
                @endauth
            </nav>

            <!-- Mobile Footer -->
            <div class="p-5" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="text-xs text-center" style="color: rgba(245,239,230,0.5);">
                    Developed by <span class="text-accent font-semibold">Nexora Solutions</span>
                </p>
            </div>
        </div>
    </div>
</header>