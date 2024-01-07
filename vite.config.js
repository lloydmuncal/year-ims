
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

// export default defineConfig({
//     plugins: [
//         vue(),
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
       host:true,
       hmr:{
        // host:"192.168.0.74",
        //  host:"10.169.140.17",
         host:"localhost"
       }
    },
});
