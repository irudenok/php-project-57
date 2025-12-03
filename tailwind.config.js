import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        // Pagination classes that might be used in Laravel's default templates
        'justify-between',
        'sm:justify-between',
        'sm:flex',
        'sm:flex-1',
        'sm:items-center',
        'sm:gap-2',
        'rtl:flex-row-reverse',
        'ltr:origin-top-left',
        'ltr:origin-top-right',
        'rtl:origin-top-left',
        'rtl:origin-top-right',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
