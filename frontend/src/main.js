//import './assets/main.css'
import './index.css'
import { createApp } from 'vue'
import App from './App.vue'
import  VueGoogleMaps from '@fawmi/vue-google-maps'
import router from './router';
import axios from 'axios';
import { createPinia } from 'pinia';
import { useUserStore } from './store/user';
//
// 设置 Axios 拦截器
// set axios interceptor
axios.defaults.withCredentials = true;// allow axios to send cookies
axios.interceptors.response.use(response => {
    // success handler
    return response;
}, error => {
    // error handler
    if (error.response && error.response.status === 401) {
        // if the error is 401 and has error.response.message
        const userStore = useUserStore();
        userStore.setLoggedOut();
        router.push('/login');
    }
    return Promise.reject(error);
});
const app = createApp(App);
const pinia = createPinia();
app.config.globalProperties.$axios = axios;
app.use(pinia);
const userStore = useUserStore();
userStore.checkLoginStatus();
app.use(VueGoogleMaps, {
    load: {
        key: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    },
});
app.use(router);
app.mount('#app')
