<template>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 z-50">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <DisclosureButton class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center text-white">
                        DEMO:morechargers
<!--                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />-->
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                    <!-- when user not logged in -->
                    <div v-if="!userStore.loggedIn" class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <a href="/login" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="/signup" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Signup</a>
                    </div>
                    <!-- when user logged in  -->
                    <!-- Profile dropdown -->
                    <div v-else class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 z-50">
<!--                        <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">-->
<!--                            <span class="absolute -inset-1.5" />-->
<!--                            <span class="sr-only">View notifications</span>-->
<!--                            <BellIcon class="h-6 w-6" aria-hidden="true" />-->
<!--                        </button>-->
                        <!-- Profile dropdown -->
                        <Menu as="div" class="ml-3 relative">
                            <div>
                                <MenuButton class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                </MenuButton>
                            </div>
                            <Transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-slot="{ active }">
                                        <a href="/profile" :class="{ 'bg-gray-100': active }" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                                    </MenuItem>
<!--                                    <MenuItem v-slot="{ active }">-->
<!--                                        <a href="/settings" :class="{ 'bg-gray-100': active }" class="block px-4 py-2 text-sm text-gray-700">Account Setting</a>-->
<!--                                    </MenuItem>-->
                                    <MenuItem v-slot="{ active }">
                                        <button @click="logout" :class="{ 'bg-gray-100': active }" class="block px-4 py-2 text-sm text-gray-700">Sign out</button>
                                    </MenuItem>
                                </MenuItems>
                            </Transition>
                        </Menu>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class=" hidden sm:hidden">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import {onMounted, ref, Transition, watch} from 'vue';
import { useUserStore } from '@/store/user';
import axios from "axios";

const userStore = useUserStore();
const navigation = ref([
    { name: 'Home', href: '/', current: false },

]);
const updateNavigation = () => {
    userStore.checkLoginStatus();
    userStore.getRole();
    // remove dashboard and survey data from navigation bar
    navigation.value = navigation.value.filter(item => item.name !== 'Dashboard' && item.name !== 'Survey Data');
    // show different navigation bar based on user role
    if (userStore.role === 'admin') {
        navigation.value.push({ name: 'Dashboard', href: '/dashboard', current: false });
    }
    if (userStore.role === 'provider') {
        navigation.value.push({ name: 'Survey Data', href: '/data', current: false });
    }
};
// watch user role change
watch(() => userStore.role, () => {
    updateNavigation();
}, { immediate: true });
const logout = () => {
    // post logout request to backend
    axios.post('/backend/api/v1/public/logout')
        .then(response => {
            // set user as logged out
            userStore.setLoggedOut();
            console.log(response);
            // redirect to login page
            window.location.href = '/';
        })
        .catch(error => {
            console.log(error);
        });
};
</script>
