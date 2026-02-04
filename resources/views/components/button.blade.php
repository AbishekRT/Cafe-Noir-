{{-- 
    Primary Button Component
    Usage: <x-button href="/link">Text</x-button>
           <x-button type="submit">Submit</x-button>
--}}
@props([
    'type' => 'button',
    'href' => null,
    'variant' => 'primary', // primary, secondary, accent
    'size' => 'md', // sm, md, lg
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    $variants = [
        'primary' => 'bg-primary text-white hover:bg-primary/90 focus:ring-primary',
        'secondary' => 'bg-secondary text-heading border border-primary/20 hover:bg-primary/5 focus:ring-primary',
        'accent' => 'bg-accent text-heading hover:bg-accent/90 focus:ring-accent',
    ];
    
    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-btn',
        'lg' => 'px-8 py-4 text-btn',
    ];
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

