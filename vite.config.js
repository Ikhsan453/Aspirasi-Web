import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                compilerOptions: {
                    // Disable problematic features that cause policy violations
                    hoistStatic: false,
                    cacheHandlers: false,
                }
            }
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        // Disable source maps in production to avoid policy issues
        sourcemap: false,
        // Optimize for modern browsers
        target: 'es2015',
        // Use esbuild for minification instead of terser
        minify: 'esbuild',
        rollupOptions: {
            output: {
                // Prevent problematic code generation
                manualChunks: undefined,
            }
        }
    },
    define: {
        // Prevent Vue from adding development-only code that might violate policies
        __VUE_PROD_DEVTOOLS__: false,
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
    }
});
