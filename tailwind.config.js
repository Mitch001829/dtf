import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/mkocansey/bladewind/resources/views/components/*.blade.php',
        './vendor/mkocansey/bladewind/resources/views/components/button/*.blade.php',
        './storage/framework/views/*.php',
        './storage/framework/views/pages/*.php',
        
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    
    darkMode: 'class',
    plugins: [forms],
   
};


