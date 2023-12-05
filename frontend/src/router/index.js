import { createRouter, createWebHistory } from 'vue-router';

// 导入你的组件
import Login from '../views/Login.vue';
import Home from '../views/Home.vue'; // 确保正确引入了 Home 组件
import Signup from "../views/Signup.vue";
import Data from "../views/Data.vue";
import Profile from "../views/Profile.vue";

// 定义路由
// 每个路由都需要映射到一个组件
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
    // ...其他路由
];

// 创建路由实例并传递 `routes` 选项
// 你可以在这里传递不同的路由配置参数
const router = createRouter({
    // 使用 HTML5 的 History 模式
    history: createWebHistory(import.meta.env.BASE_URL),
    routes, // 短语法，相当于 routes: routes
});

export default router;
