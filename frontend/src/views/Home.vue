<template>
    <div class="flex flex-row h-full">
        <div class="flex-grow h-full">
            <Map :markers="mapCoordinates" @clickedPositionEvent="handleUpdatePosition"/>
        </div>
        <div class="w-1/3">
            <Survey :clickedPosition="clickedPosition" />
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Map from '../components/Map.vue';  //use @ to represent the src folder
import Survey from "../components/Survey.vue";

export default {
    components: {
        Map,
        Survey
    },
    data() {
        return {
            clickedPosition: null, // initialize clickedPosition to null
            mapCoordinates: []
        }
    },
    methods: {
        handleUpdatePosition(position) {
            console.log('handleUpdatePosition called in Home.vue');
            // 更新父组件的 clickedPosition 数据
            this.clickedPosition = position;
        },
        async fetchMapData() {
            try {
                const response = await axios.get('/backend/api/v1/public/map-coordinates');
                this.mapCoordinates = response.data;
            } catch (error) {
                console.error('Error fetching map data:', error);
            }
        }
    },
    mounted() {
        this.fetchMapData();
    }

};
</script>

<style scoped>
/* Add any additional styles here */
</style>
