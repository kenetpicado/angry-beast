import defaultTheme from 'tailwindcss/defaultTheme';
import { PRIMARY, PRIMARY_DARK, PRIMARY_LIGHT } from './theme.js';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        // screens: {
        //     ...defaultTheme.screens
        // },
        extend: {
            colors: {
                stroke: '#E2E8F0',
                primary: PRIMARY,
                'primary-light': PRIMARY_LIGHT,
                'primary-dark': PRIMARY_DARK,
            },
        }
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
};
