import { createRouter, createWebHistory } from 'vue-router';

// 导入你的组件
import Login from '../views/Login.vue';
import Home from '../views/Home.vue';
import Signup from "../views/Signup.vue";
import Data from "../views/Data.vue";
import Profile from "../views/Profile.vue";
import DashBoard from "../views/DashBoard.vue";

// define your routes
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/signup',
        name: 'Signup',
        component: Signup,
    },
    {
        path: '/data',
        name: 'Data',
        component: Data,
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
    },
    {
        path: '/dashboard',
        name: 'DashBoard',
        component: DashBoard,
    },
];

// create the router instance and pass the `routes` option
const router = createRouter({
    // use appropriate history mode for your deploy environment
    history: createWebHistory(import.meta.env.BASE_URL),
    routes, // short for routes: routes
});

export default router;
