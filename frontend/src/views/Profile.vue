<template>
    <div class="container mx-auto p-4">
        <div class="profile bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-2xl font-semibold mb-4">Profile</h2>
            <div v-if="user">
                <div class="mb-2"><strong>Name:</strong> {{ user.name }}</div>
                <div class="mb-2"><strong>Email:</strong> {{ user.email }}</div>
                <div class="mb-2"><strong>Account Type:</strong> {{ user.account_type }}</div>
                <!-- 更多用户信息 -->
            </div>
            <div v-else>
                Loading user information...
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null
        };
    },
    mounted() {
        this.fetchUserProfile();
    },
    methods: {
        fetchUserProfile() {
            axios.get('/backend/api/v1/private/user/profile')
                .then(response => {
                    this.user = response.data;
                    console.log(this.user);
                })
                .catch(error => {
                    console.error('Error fetching user profile:', error);
                });
        }
    }
};
</script>

<style>
/* 这里可以添加一些自定义样式，如果需要 */
</style>
