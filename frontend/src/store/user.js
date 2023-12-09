// src/store/user.js
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
    state: () => ({
        loggedIn: false,
        role: '',
    }),
    actions: {
        setLoggedIn() {
            this.loggedIn = true;
            localStorage.setItem('loggedIn', 'true');
        },
        setLoggedOut() {
            this.loggedIn = false;
            localStorage.setItem('loggedIn', 'false');
        },
        checkLoginStatus() {
            this.loggedIn = localStorage.getItem('loggedIn') === 'true';
        },
        setRole(role) {
            this.role = role;
            localStorage.setItem('role', role);
        },
        getRole() {
            this.role = localStorage.getItem('role');
        },
    }
});
