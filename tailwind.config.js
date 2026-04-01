import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                orbitron: ['Orbitron', 'sans-serif'],
            },
            colors: {
                neonBlue: '#00f3ff',
                neonPurple: '#bc13fe',
                darkBlack: '#0a0a0a',
                darkGray: '#1a1a1a',
            },
            boxShadow: {
                neonBlue: '0 0 5px #00f3ff, 0 0 20px #00f3ff',
                neonPurple: '0 0 5px #bc13fe, 0 0 20px #bc13fe',
            },
        },
    },
    plugins: [],
};
