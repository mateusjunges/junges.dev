import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.admin.css',
                'resources/js/app.js',
                'resources/css/filament.css',
            ],
            buildDirectory: '/adminAssets',
        }),
    ],
    css: {
        postcss: {
            plugins: [
                require("tailwindcss/nesting"),
                require("tailwindcss")({
                    config: "./tailwind.admin.config.js",
                }),
                require("autoprefixer"),
            ],
        }
    }
});
