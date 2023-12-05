<template>
    <div class="flex-grow mb-16">
        <Map :coordinates="mapCoordinates"/>
    </div>
</template>

<script setup>
import Map from '@/components/Map.vue'; // 使用 @ 符号作为 src 目录的别名
import { ref, onMounted } from 'vue';
import axios from 'axios';

const mapCoordinates = ref([]);

const fetchMapData = async () => {
    try {
        const response = await axios.get('/backend/api/v1/public/map-coordinates');
        mapCoordinates.value = response.data;
    } catch (error) {
        console.error('Error fetching map data:', error);
    }
};

onMounted(fetchMapData);
// 此处不需要使用 export default
// not need to use export default here
// 如果你需要定义组件的名称，可以使用 defineComponent 函数
// If you need to define the name of the component, you can use the defineComponent function

// add data, methods



</script>

<style scoped>
/* Add any additional styles here */
</style>
