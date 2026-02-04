{{--
Cafe Noir Footer Component
Includes: Brand Info, Navigation Links, Social Media, Developer Credit
--}}
<footer class="bg-primary text-white mt-16">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <svg class="h-10 w-10" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <span class="font-heading text-2xl font-bold">Cafe Noir</span>
                </div>
                <p class="text-secondary/80 text-sm leading-relaxed">
                    Premium artisan coffee sourced from the finest beans around the world.
                    Experience the rich, bold flavors that define exceptional coffee.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-heading text-lg font-semibold text-accent mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}"
                            class="text-secondary/80 hover:text-accent transition-colors text-sm">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop.index') }}"
                            class="text-secondary/80 hover:text-accent transition-colors text-sm">
                            Shop
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.about') }}"
                            class="text-secondary/80 hover:text-accent transition-colors text-sm">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.faqs') }}"
                            class="text-secondary/80 hover:text-accent transition-colors text-sm">
                            FAQs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.contact') }}"
                            class="text-secondary/80 hover:text-accent transition-colors text-sm">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="font-heading text-lg font-semibold text-accent mb-4">Contact Us</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-accent flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-secondary/80">{{ config('cafe.contact.address') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-accent flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span class="text-secondary/80">{{ config('cafe.contact.phone') }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-accent flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="text-secondary/80">{{ config('cafe.contact.email') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h4 class="font-heading text-lg font-semibold text-accent mb-4">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="{{ config('cafe.social.facebook') }}" target="_blank" rel="noopener"
                        class="bg-white/10 hover:bg-accent text-white hover:text-heading p-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z" />
                        </svg>
                    </a>
                    <a href="{{ config('cafe.social.instagram') }}" target="_blank" rel="noopener"
                        class="bg-white/10 hover:bg-accent text-white hover:text-heading p-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.66,4.77-4.92,4.92-1.27.06-1.65.07-4.85.07s-3.58,0-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.9,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.35.2-6.78,2.62-7,7C0,8.33,0,8.74,0,12s0,3.67.07,4.95c.2,4.36,2.62,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.35-.2,6.78-2.62,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.35-2.62-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z" />
                        </svg>
                    </a>
                    <a href="{{ config('cafe.social.twitter') }}" target="_blank" rel="noopener"
                        class="bg-white/10 hover:bg-accent text-white hover:text-heading p-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div
            class="border-t border-white/10 mt-10 pt-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-secondary/60 text-sm">
                &copy; {{ date('Y') }} Cafe Noir. All rights reserved.
            </p>
            <p class="text-secondary/60 text-sm">
                Developed by <a href="#" class="text-accent hover:text-white font-semibold transition-colors">Nexora
                    Solutions</a>
            </p>
        </div>
    </div>
</footer>

