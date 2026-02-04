import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/**
 * Cafe Noir Design System
 * 
 * Colors:
 * - Primary: #4E342E (Dark Brown)
 * - Secondary: #F5EFE6 (Cream/Beige)
 * - Accent: #C9A24D (Gold)
 * - Heading: #2E1F1A (Dark Brown)
 * - Body: #4A3B36 (Medium Brown)
 * - Muted: #7A6A65 (Gray Brown)
 * 
 * Fonts:
 * - Headings: Playfair Display
 * - Body/UI: Inter
 */

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Brand Colors
                primary: '#4E342E',
                secondary: '#F5EFE6',
                accent: '#C9A24D',
                
                // Text Colors
                heading: '#2E1F1A',
                body: '#4A3B36',
                muted: '#7A6A65',
            },
            fontFamily: {
                heading: ['Playfair Display', 'serif'],
                body: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                // Custom font sizes per design system
                'body': ['16px', { lineHeight: '1.6' }],
                'h1': ['48px', { lineHeight: '1.2' }],
                'h2': ['32px', { lineHeight: '1.3' }],
                'h3': ['22px', { lineHeight: '1.4' }],
                'btn': ['15px', { lineHeight: '1.5', fontWeight: '600' }],
            },
            maxWidth: {
                'content': '1200px',
            },
            borderRadius: {
                DEFAULT: '8px',
            },
            spacing: {
                'section': '64px',
            },
            boxShadow: {
                'subtle': '0 2px 8px rgba(78, 52, 46, 0.08)',
                'card': '0 4px 12px rgba(78, 52, 46, 0.1)',
            },
        },
    },

    plugins: [forms],
};
