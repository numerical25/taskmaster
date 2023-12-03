import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
export default defineConfig({
    resolve: {
        alias: {
            '@/fonts': './src/assets/fonts',
        },
    },
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.ts',
                'resources/js/app.tsx'],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: ['d3-force'],
    },
});
