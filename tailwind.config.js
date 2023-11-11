import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Rosa Sans', 'Plus Jakarta Sans', 'inter', 'rubik', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: "#ffbd59",
                secondary: "#eba946",
                info: "#F15A59",
                danger: "#D21312",
                success: "#5D9C59",
                warning: "#FD8D14",
                light: "#F2F2F2",
                dark: "#070A52",
                black: "#29324d",
                white: "#FFFFFF",
                gray: {
                    100: "#F2F2F2",
                    200: "#E0E0E0",
                    300: "#BDBDBD",
                    400: "#464646",
                    500: "#4F4F4F",
                    600: "#333333",
                    700: "#1A1A1A",
                    800: "#070A52",
                    900: "#29324d",
                },
                orange: {
                    100: "#FFF3E0",
                    200: "#FFE0B2",
                    300: "#FFCC80",
                    400: "#FFB74D",
                    500: "#FFA726",
                    600: "#FB8C00",
                    700: "#F57C00",
                    800: "#EF6C00",
                    900: "#E65100",
                },
            },
        },
        fontSize: {
            xs: '.75rem', // 12px
            sm: '0.8rem',
            md: '0.875rem', // 14px
            base: '1rem',
            lg: '1.125rem', // 18px
            xl: '1.25rem',
            '2xl': '1.563rem',
            '3xl': '1.953rem',
            '4xl': '2.441rem',
            '5xl': '3.052rem',
            '6xl': '3.815rem',
            '7xl': '4.768rem',
            '8xl': '5.96rem',
        },
        // font weight
        fontWeight: {
            light: 300,
            normal: 400,
            medium: 500,
            semibold: 600,
            bold: 700,
        },
    },

    plugins: [forms, require('flowbite/plugin')],
};
