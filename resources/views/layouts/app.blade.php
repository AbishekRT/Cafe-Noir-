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

    @stack('styles')
</head>

<body class="font-body antialiased bg-secondary text-body">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('layouts.partials.header')

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')

        <!-- Floating WhatsApp Button -->
        @include('layouts.partials.whatsapp-button')
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div id="flash-message" class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="flash-message" class="fixed bottom-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif

    @if (session('info'))
        <div id="flash-message" class="fixed bottom-4 right-4 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('info') }}
        </div>
    @endif

    <script>
        // Auto-hide flash messages
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                flash.style.transition = 'opacity 0.5s';
                setTimeout(() => flash.remove(), 500);
            }
        }, 5000);
    </script>

    @stack('scripts')
</body>

</html>
