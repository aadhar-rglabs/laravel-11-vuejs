import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; 

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // 'public/assets/css/adminlte.min.css', 
                // 'public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                // 'public/assets/plugins/fontawesome-free/css/all.min.css',
                'public/assets/plugins/jquery/jquery.min.js',
                'public/assets/js/adminlte.min.js',
                'public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
            ],
            refresh: true,
        }),
        vue({ 
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
