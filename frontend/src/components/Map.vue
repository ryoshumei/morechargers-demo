<template>
<div class="flex h-full">
    <GMapMap
        ref="gmap"
        :center="center"
        :zoom="7"
        map-type-id="terrain"
        :options="{
                gestureHandling: 'greedy',
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: false
        }"
        class="w-3/4 h-full"
        @click="handleMapClick"
    >
        <GMapMarker
            v-if="clickedPosition"
            :position="clickedPosition"
        />
    </GMapMap>
    <div v-if="clickedPosition" class="w-1/4 h-full">
        <form @submit.prevent="submitForm" class="ml-2">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Property
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Value
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    Latitude
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ clickedPosition.lat }}
                </td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    Longitude
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ clickedPosition.lng }}
                </td>
            </tr>
            <!-- ...其他坐标属性 -->
            </tbody>
        </table>

            <div class="mb-4">
                <label for="radius" class="block text-sm font-medium text-gray-700">Desired range radius:</label>
                <select id="radius" v-model="formData.radius" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="1">1 km</option>
                    <option value="5">5 km</option>
                    <option value="10">10 km</option>
                </select>
            </div>

            <div class="mb-4">
                <span class="block text-sm font-medium text-gray-700">Do you own an electric vehicle?</span>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" v-model="formData.hasEv" value="yes" class="form-radio" name="hasEv">
                        <span class="ml-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" v-model="formData.hasEv" value="no" class="form-radio" name="hasEv">
                        <span class="ml-2">No</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700">Electric vehicle brand:</label>
                <input type="text" id="brand" v-model="formData.evBrand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="model" class="block text-sm font-medium text-gray-700">Electric vehicle model:</label>
                <input type="text" id="model" v-model="formData.evModel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="power" class="block text-sm font-medium text-gray-700">Desired charging station power:</label>
                <input type="text" id="power" v-model="formData.chargingPower" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="chargingBrand" class="block text-sm font-medium text-gray-700">Desired charging station brand:</label>
                <input type="text" id="chargingBrand" v-model="formData.chargingBrand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </form>
    </div>
</div>
</template>

<script >
export default {
    name: 'Map',
    data() {
        return {
            center: { lat: 35.6895, lng: 139.6917 },//tokyo
            clickedPosition: null,
            bounds: {
                north: 45.551483,
                south: 24.396308,
                west: 122.93457,
                east: 153.986672,
            },
            formData: {
                radius: '',
                hasEv: '',
                evBrand: '',
                evModel: '',
                chargingPower: '',
                chargingBrand: ''
            },
        }
    },

    methods: {
        handleMapClick(event) {
            // event to show clicked position on map
            this.clickedPosition = {
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            };
            // output clicked position
            console.log(`Clicked position: ${this.clickedPosition.lat}, ${this.clickedPosition.lng}`);
        },
        submitForm() {
            // 在这里处理表单提交
            console.log('Form Data:', this.formData);
            // 发送数据到服务器或其他处理
        }
    }
}
</script>
