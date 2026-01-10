import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Cairo', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand': {
                    DEFAULT: '#2EBBD3',
                    light: '#eaf8fa', // درجة فاتحة للخلفيات
                    dark: '#2596ab',  // درجة أغمق للـ hover
                },
            },
        },
    },

    plugins: [forms],
};