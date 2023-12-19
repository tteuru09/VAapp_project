import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
        "./node_modules/tw-elements/dist/js/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            backgroundImage: {
                'vaapp': "url('/public/img/Bg-VAapp.jpg')",
            }
        },

        container: {
            center: true,
        },

        colors: { 
            'bondi_blue': { DEFAULT: '#0795B8', 100: '#011d24', 200: '#033b49', 300: '#04586d', 400: '#057692', 500: '#0795b8', 600: '#09c5f4', 700: '#45d4f8', 800: '#83e3fb', 900: '#c1f1fd' }, 
            'hunyadi_yellow': { DEFAULT: '#F7BF68', 100: '#432b04', 200: '#865507', 300: '#c9800b', 400: '#f4a526', 500: '#f7bf68', 600: '#f9cd87', 700: '#fadaa5', 800: '#fce6c3', 900: '#fdf3e1' }, 
            'teal': { DEFAULT: '#05797F', 100: '#011819', 200: '#023033', 300: '#03494c', 400: '#046166', 500: '#05797f', 600: '#08bec8', 700: '#26ecf6', 800: '#6ef2f9', 900: '#b7f9fc' }, 
            'caribbean_current': { DEFAULT: '#0F6770', 100: '#031516', 200: '#06292d', 300: '#093e43', 400: '#0c525a', 500: '#0f6770', 600: '#18a4b4', 700: '#35d2e3', 800: '#78e1ed', 900: '#bcf0f6' }, 
            'ecru': { DEFAULT: '#D3C68D', 100: '#332d14', 200: '#655a27', 300: '#98873b', 400: '#bfad5a', 500: '#d3c68d', 600: '#dcd1a4', 700: '#e4ddbb', 800: '#ede8d1', 900: '#f6f4e8' },
            'fern_green': { DEFAULT: '#467627', 100: '#0e1808', 200: '#1c2f10', 300: '#2b4718', 400: '#395f20', 500: '#467627', 600: '#67ab39', 700: '#8bca61', 800: '#b2dc95', 900: '#d8edca' },
            'photo_blue': { DEFAULT: '#ADE5FB', 100: '#043b51', 200: '#0876a2', 300: '#0bb1f3', 400: '#5bcbf7', 500: '#ade5fb', 600: '#bdeafc', 700: '#cdeffd', 800: '#def4fd', 900: '#eefafe' }, 
            'azure_web': { DEFAULT: '#EEFDFE', 100: '#05575d', 200: '#0badb9', 300: '#33e6f3', 400: '#8ff1f8', 500: '#eefdfe', 600: '#f0fdfe', 700: '#f3fefe', 800: '#f7feff', 900: '#fbffff' },
            'steel_blue': { DEFAULT: '#4288C3', 100: '#0c1b28', 200: '#19374f', 300: '#255277', 400: '#326d9e', 500: '#4288c3', 600: '#67a0cf', 700: '#8db8db', 800: '#b3d0e7', 900: '#d9e7f3' },
        }
    },

    plugins: [
        require("tw-elements/dist/plugin.cjs"),
        require('flowbite/plugin'),
        forms
    ],
};
