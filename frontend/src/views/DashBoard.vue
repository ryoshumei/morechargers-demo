<template>
    <div class="dashboard p-6">
        <div class="stats grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="stat bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center">
                <h3 class="text-xl font-semibold mb-2">UserCount</h3>
                <p class="text-3xl font-bold">{{ userCount }}</p>
            </div>
            <router-link to="/data" class="stat bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center hover:bg-gray-100">
                <h3 class="text-xl font-semibold mb-2">SurveyCount</h3>
                <p class="text-3xl font-bold">{{ surveyCount }}</p>
            </router-link>
            <div class="stat bg-white shadow-md rounded-lg p-4 flex flex-col items-center justify-center">
                <h3 class="text-xl font-semibold mb-2">ProviderCount</h3>
                <p class="text-3xl font-bold">{{ providerCount }}</p>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            userCount: 0,
            surveyCount: 0,
            providerCount: 0,
        };
    },
    mounted() {
        this.fetchCounts();
    },
    methods: {
        fetchCounts() {
            // 替换为您的 API 调用
            axios.get('/backend/api/v1/private/users/count').then(response => {
                console.log(response);
                this.userCount = response.data;
            });
            axios.get('/backend/api/v1/private/surveys/count').then(response => {
                this.surveyCount = response.data;
            });
            axios.get('/backend/api/v1/private/providers/count').then(response => {
                this.providerCount = response.data;
            });
            // 处理错误和异常情况
        },
    },
};
</script>

<style>
</style>
