import typography from '@tailwindcss/typography';
import daisyui from "daisyui";

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            colors: {
                'background': '#F8F8F8',
            },
            fontFamily: {
                sans: ['Gotham Rounded Book', 'Noto Sans', 'sans-serif'],
                bold: ['Gotham Rounded Bold', 'Noto Sans', 'sans-serif'],
                medium: ['Gotham Rounded', 'Noto Sans', 'sans-serif']
            },
            screens: {
                'xs': '420px',
            }
        },
    },

    plugins: [
        typography, daisyui
    ],

    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "primary": "#5A3184",
                    "secondary": "#4F525B",
                    "accent": "#040304",
                    "neutral": "#A0A2A7",
                    "neutral-content": "#E8E8E8",
                    "success": "#63B259",
                    "success-content": "#EBF8ED",
                    "error": "#BA381E",
                    "error-content": "#F9EEEC",
                },
            },
        ]
    },
}

