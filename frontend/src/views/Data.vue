<template>
    <div class="p-6 mb-20 pb-20">
        <h2 class="text-2xl font-bold mb-4">User Survey Data</h2>
        <div v-if="locations.length > 0">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- 表头 -->
                <thead class="bg-gray-50">
                <tr>
                    <!-- 确保这些标题与您的数据对象的属性相匹配 -->
                    <th>Id</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Hope Radius (km)</th>
                    <th>Brand Name</th>
                    <th>Model Name</th>
                    <th>Charger Type Name</th>
                    <th>Provider Company Name</th>
                    <th>Comment</th>
                </tr>
                </thead>
                <!-- 表格主体 -->
                <tbody class="bg-white divide-y divide-gray-200 mb-20">
                <tr v-for="(data, index) in locations" :key="index">
                    <!-- 确保这些字段与您的数据对象的属性相匹配 -->
                    <td>{{ data.id }}</td>
                    <td>{{ data.latitude }}</td>
                    <td>{{ data.longitude }}</td>
                    <td>{{ data.hope_radius }}</td>
                    <td>{{ data.brand_name }}</td>
                    <td>{{ data.model_name }}</td>
                    <td>{{ data.charger_type_name }}</td>
                    <td>{{ data.provider_company_name }}</td>
                    <td>{{ data.comment }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-else>
            <p>No survey data to display.</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'Data',
    data() {
        return {
            // This would be populated with survey data
            surveyData: [
                // Mock data - you would populate this with real data as it's collected
                { username: 'User1', email: 'user1@example.com', evBrand: 'Brand1' },
                { username: 'User2', email: 'user2@example.com', evBrand: 'Brand2' },
                // ... more data
            ],
            locations: [],
        };
    },
    mounted() {
        this.fetchLocations();
    },
    methods: {
        fetchLocations() {
            // fetch locations from backend
            axios.get('/backend/api/v1/private/desired-location')
                .then(response => {
                    this.locations = response.data.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.error("There was an error fetching the locations:", error);
                });
        },
    },
    // Add methods, computed properties, or watchers as needed to handle data updates
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
