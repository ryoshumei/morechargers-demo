//import './assets/main.css'
import './index.css'
import { createApp } from 'vue'
import App from './App.vue'
import  VueGoogleMaps from '@fawmi/vue-google-maps'
import router from './router';
//
const app = createApp(App);
app.use(VueGoogleMaps, {
    load: {
        key: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    },
});
app.use(router);
app.mount('#app')
