<template>
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow flex items-center justify-center bg-gray-100 px-6 pt-20 pb-16">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h2 class="text-center text-3xl font-extrabold text-gray-900">
                        Create your account
                    </h2>
                </div>
                <form class="mt-8 space-y-6" @submit.prevent="signup">
                    <div>
                        <span class="block text-sm font-medium text-gray-700">Account Type:</span>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" v-model="accountType" value="user" class="form-radio" name="accountType">
                                <span class="ml-2">User Account</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" v-model="accountType" value="provider" class="form-radio" name="accountType">
                                <span class="ml-2">EV Charger Provider</span>
                            </label>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="username" class="sr-only">Username</label>
                            <input id="username" name="username" type="text" autocomplete="username" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username">
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Email address">
                        </div>
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Password">
                        </div>
                        <div>
                            <label for="password-confirm" class="sr-only">Confirm Password</label>
                            <input id="password-confirm" name="password-confirm" type="password" autocomplete="new-password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Signup',
    data() {
        return {
            // Add any form fields you need here
            formData: {
                accountType: '', // 默认值为空，用户必须选择一个
                username: '',
                email: '',
                password: '',
                passwordConfirm: '',
            },


        };
    },
    methods: {
        signup() {
            // Handle the signup logic here
            console.log('Signup form submitted');
            console.log('Signup form submitted with account type: ', this.accountType);
            // For example, send a request to your backend
            // this.$axios.post('/api/signup', { ... })
            //   .then(response => { ... })
            //   .catch(error => { ... });
        },
    },
};
</script>

<style scoped>
/* Add any additional styles here */
</style>

