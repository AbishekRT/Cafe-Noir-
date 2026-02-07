<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Cafe Noir - Premium Coffee' }}</title>
    <meta name="description"
        content="{{ $metaDescription ?? 'Cafe Noir - Premium artisan coffee beans and blends. Experience the finest coffee from around the world.' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|inter:300,400,500,600,700&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/css/custom.css">

    @stack('styles')
</head>

<body class="font-body antialiased bg-secondary text-body">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('layouts.partials.header')

        <!-- Main Content -->
        <main class="flex-grow page-enter">
            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')

        <!-- Floating WhatsApp Button -->
        @include('layouts.partials.whatsapp-button')
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div id="flash-message" class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg z-50"
            style="box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="flash-message" class="fixed bottom-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg z-50"
            style="box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div id="flash-message" class="fixed bottom-4 right-4 bg-blue-600 text-white px-6 py-3 rounded-lg z-50"
            style="box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('info') }}</span>
            </div>
        </div>
    @endif

    <script>
        // Auto-hide flash messages with smooth animation
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(10px)';
                flash.style.transition = 'opacity 0.5s, transform 0.5s';
                setTimeout(() => flash.remove(), 500);
            }
        }, 5000);

        // Scroll-triggered reveal animations
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            if (reveals.length === 0) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

            reveals.forEach(el => observer.observe(el));
        });
    </script>

    @stack('scripts')
</body>

</html>