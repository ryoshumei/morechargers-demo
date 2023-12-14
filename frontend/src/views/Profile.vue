<template>
    <div class="container mx-auto p-4">
        <div class="profile bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-2xl font-semibold mb-4">Profile</h2>
            <div v-if="user">
                <div class="mb-2"><strong>Name:</strong> {{ user.name }}</div>
                <div class="mb-2"><strong>Email:</strong> {{ user.email }}</div>
                <div class="mb-2"><strong>Account Type:</strong> {{ user.account_type }}</div>

                <!--edit profile including password -->
                <br>
                <div class="mb-2"><strong>Edit Profile: </strong></div>
                <form @submit.prevent="updateProfile" class="space-y-4">
                    <input type="text" v-model="newName" placeholder="New Name" class="w-1/4 p-2 border rounded">
<!--                    todo : add password change-->
<!--                    <br>-->
<!--                    <input type="password" v-model="currentPassword" placeholder="Current Password" class="w-1/4 p-2 border rounded">-->
<!--                    <br>-->
<!--                    <input type="password" v-model="newPassword" placeholder="New Password" class="w-1/4 p-2 border rounded">-->
<!--                    <br>-->
<!--                    <input type="password" v-model="confirmPassword" placeholder="Confirm New Password" class="w-1/4 p-2 border rounded">-->
                    <br>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Profile</button>
                </form>

                <!-- 删除账户按钮 -->
                <button @click="deleteAccount" class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete Account</button>
            </div>
            <div v-else>
                Loading user information...
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {useUserStore} from "../store/user";

export default {
    data() {
        return {
            user: null,
            newName: '',
            // todo : add password change
            // currentPassword: '',
            // newPassword: '',
            // confirmPassword: ''

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
        },
        updateProfile() {
            // todo : add password change
            // if (this.newPassword !== this.confirmPassword) {
            //     alert('New passwords do not match');
            //     return;
            // }

            // post request to backend
            axios.patch('/backend/api/v1/private/user/profile', {
                name: this.newName,
                // todo : add password change
                // currentPassword: this.currentPassword,
                // newPassword: this.newPassword
            })
                .then(response => {
                    // handle success
                    console.log(response);
                    alert('Profile updated successfully');
                    // refresh user profile
                    this.fetchUserProfile();
                })
                .catch(error => {
                    // handle error
                    console.error('Error updating profile:', error);
                    alert('Error updating profile. Please try again.');
                });
        },
        deleteAccount() {
            // add confirmation
            if (!confirm('Are you sure you want to delete your account?')) {
                return;
            }
            // delete request to backend
            axios.delete('/backend/api/v1/private/user')
                .then(response => {
                    // handle success
                    console.log(response);
                    alert('Account deleted successfully');
                    let userStore = useUserStore();
                    userStore.setLoggedOut();
                    // redirect to login page
                    window.location.href = '/';
                })
                .catch(error => {
                    // handle error
                    console.error('Error deleting account:', error);
                    alert('Error deleting account. Please try again.');
                });
        }
    }
};
</script>

<style>
/* 这里可以添加一些自定义样式，如果需要 */
</style>
