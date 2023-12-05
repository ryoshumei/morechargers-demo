import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        vue(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url))
        }
    },
    server: {
        host: '0.0.0.0',  // allow external access
        port: 3000,  // default: 3000
        proxy: {
            '/backend': {
                target: 'http://laravel_api:80',
                changeOrigin: true,
                rewrite: (path) => path.replace(/^\/backend/, ''),

                configure: (proxy, _options) => {
                    proxy.on("error", (err, _req, _res) => {
                        console.log("proxy error", err);
                    });
                    proxy.on("proxyReq", (proxyReq, req, _res) => {
                        console.log(
                            "Sending Request:",
                            req.method,
                            req.url,
                            " => TO THE TARGET =>  ",
                            proxyReq.method,
                            proxyReq.protocol,
                            proxyReq.host,
                            proxyReq.path,
                            JSON.stringify(proxyReq.getHeaders()),
                        );
                    });
                    proxy.on("proxyRes", (proxyRes, req, _res) => {
                        console.log(
                            "Received Response from the Target:",
                            proxyRes.statusCode,
                            req.url,
                            JSON.stringify(proxyRes.headers),
                        );
                    });
                }// default: 'info'
            }
        }
    },
    optimizeDeps: {
        include: [
            "@fawmi/vue-google-maps",
            "fast-deep-equal",
        ],
    },
});
