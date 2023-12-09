<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="login">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input v-model="email" id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input v-model="password" id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { useUserStore } from '@/store/user';
import axios from "axios";
export default {
    data() {
        return {
            email: '',
            password: '',
            role: ''
        };
    },
    name: 'Login',
    methods: {
        login() {
            const userStore = useUserStore();
            // 在这里处理登录逻辑
            // 通常是调用一个API，然后根据响应来处理
            console.log('Login form submitted');
            console.log('Login form submitted2');
            this.$axios.get('/backend/sanctum/csrf-cookie').then(response => {
                // Login...
                console.log(response);
                // CSRF token is set, now you can make a login request
                this.$axios.post('/backend/api/v1/public/login', {
                    // id="email-address"
                    email: this.email,
                    password: this.password
                }).then(response => {
                    console.log('Login successful', response);
                    userStore.setLoggedIn(true);
                    // Handle successful login
                    this.getUserRole().then(role => {
                        userStore.setRole(role);
                        this.$router.push('/');
                    }).catch(error => {
                        console.error('Error setting user role:', error);
                        // 这里处理角色设置失败的情况
                    });
                }).catch(error => {
                    console.error('Login error', error);
                    // Handle login errors, e.g., show an error message
                    alert('Login failed. Please try again.');


                });
            }).catch(error => {
                console.error('CSRF token retrieval error', error);
                // Handle CSRF token retrieval error
            });

        },
        // get user role
        getUserRole() {
            return axios.get('/backend/api/v1/private/user/profile')
                .then(response => {
                    return response.data.user_role;
                })
                .catch(error => {
                    console.error('Error fetching user role:', error);
                    throw error;
                });
        }
    }
};
</script>
