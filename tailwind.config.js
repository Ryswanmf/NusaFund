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
                sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                maroon: {
                    50: '#fff1f1',
                    100: '#ffdfdf',
                    200: '#ffc6c6',
                    300: '#ffa1a1',
                    400: '#ff6c6c',
                    500: '#f83b3b',
                    600: '#e61d1d',
                    700: '#c11414',
                    800: '#800000',
                    900: '#851414',
                    950: '#4a0606',
                },
            },
        },
    },

    plugins: [forms],
};
