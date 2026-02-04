<?php

/**
 * Cafe Noir Configuration
 * 
 * Application-specific settings for the Cafe Noir e-commerce platform.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Tax Rate
    |--------------------------------------------------------------------------
    |
    | The tax rate to apply to orders (as a percentage).
    | Set to 0 for no tax. Example: 8.5 for 8.5% tax rate.
    |
    */
    'tax_rate' => env('CAFE_TAX_RATE', 8.0),

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | The currency settings for the application.
    |
    */
    'currency' => [
        'code' => env('CAFE_CURRENCY_CODE', 'USD'),
        'symbol' => env('CAFE_CURRENCY_SYMBOL', '$'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Shop Settings
    |--------------------------------------------------------------------------
    |
    | Settings for the shop listing page.
    |
    */
    'shop' => [
        'products_per_page' => 12,
        'featured_cache_ttl' => 60, // seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | Business contact information displayed on the website.
    |
    */
    'contact' => [
        'email' => env('CAFE_CONTACT_EMAIL', 'hello@cafenoir.com'),
        'phone' => env('CAFE_CONTACT_PHONE', '+1 (555) 123-4567'),
        'address' => env('CAFE_CONTACT_ADDRESS', '123 Coffee Street, Brew City, BC 12345'),
        'whatsapp' => env('CAFE_WHATSAPP', '+15551234567'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    |
    | Links to social media profiles.
    |
    */
    'social' => [
        'facebook' => env('CAFE_SOCIAL_FACEBOOK', 'https://facebook.com/cafenoir'),
        'instagram' => env('CAFE_SOCIAL_INSTAGRAM', 'https://instagram.com/cafenoir'),
        'twitter' => env('CAFE_SOCIAL_TWITTER', 'https://twitter.com/cafenoir'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Stripe Settings
    |--------------------------------------------------------------------------
    |
    | Stripe payment configuration.
    | Use test keys for development.
    |
    */
    'stripe' => [
        'enabled' => env('STRIPE_ENABLED', true),
        'key' => env('STRIPE_KEY', ''),
        'secret' => env('STRIPE_SECRET', ''),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Maps
    |--------------------------------------------------------------------------
    |
    | Google Maps embed settings for the contact page.
    |
    */
    'google_maps' => [
        'embed_url' => env('CAFE_GOOGLE_MAPS_EMBED', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596073366!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1640000000000!5m2!1sen!2s'),
    ],

];
