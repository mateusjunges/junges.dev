import laravel from 'laravel-vite-plugin'
import {defineConfig} from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/utilities/copy-button.js',
                'resources/css/filament.css',
                'resources/css/utilities/line-numbers.css',
            ],
        }),
    ],
})

