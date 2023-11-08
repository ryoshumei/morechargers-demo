import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css';
import { GoogleMap } from 'vue3-google-map';

const app = createApp(App);
app.use(GoogleMap, {
    load: {
        key: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    },
});

app.mount('#app')
