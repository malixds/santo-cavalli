import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Важно для Docker!
        hmr: {
            host: 'localhost', // Или ваш домен
            protocol: 'ws',
        },
        watch: {
            usePolling: true, // Необходимо для Docker на Windows/WSL2
        },
    },
});
