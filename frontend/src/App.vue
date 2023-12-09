<template>
    <div class="flex flex-col h-screen">
        <Navbar/>
        <!-- router-view 会根据当前路由渲染对应的组件 -->
        <router-view></router-view>
        <Footer class="mt-auto" /> <!-- mt-auto 用于将 Footer 推到页面底部 -->
    </div>
</template>

<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

</script>

<style scoped>
</style>
