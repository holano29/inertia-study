import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss'

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
            postcss: [
                tailwindcss(),
                autoprefixer(),
            ]
        }),
    ],
});
