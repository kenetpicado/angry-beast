import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        screens: {
            ...defaultTheme.screens
        },
        extend: {
            colors: {
                current: 'currentColor',
                transparent: 'transparent',
                black: '#1C2434',
                primary: '#2a9235',
                secondary: '#80CAEE',
                stroke: '#E2E8F0',
            },
        }
    },

    plugins: [],
};
