<template>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">User Survey Data</h2>
        <div v-if="surveyData.length > 0">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Username
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        EV Brand
                    </th>
                    <!-- Add more table headers based on the form data you are collecting -->
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(data, index) in surveyData" :key="index">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ data.username }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ data.email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ data.evBrand }}
                    </td>
                    <!-- Add more table cells based on the form data you are collecting -->
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
        };
    },
    // Add methods, computed properties, or watchers as needed to handle data updates
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
