<template>
<div>
<div v-if="clickedPosition" class="bg-white p-4 shadow rounded-lg">
    <form @submit.prevent="submitForm">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Latitude</label>
                <input type="text" readonly :value="formData.latitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Longitude</label>
                <input type="text" readonly :value="formData.longitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            </div>
        </div>
        <div class="mt-4">
            <label for="radius" class="block text-gray-700 text-sm font-bold mb-2">Desired range radius:</label>
            <select id="radius" v-model="formData.radius" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option v-for="radius in radiusNums" :value="radius">{{ radius }} km</option>
            </select>
        </div>
        <div class="mt-4">
            <span class="block text-gray-700 text-sm font-bold mb-2">Do you own an electric vehicle?</span>
            <div class="flex items-center">
                <label class="inline-flex items-center mr-6">
                    <input type="radio" v-model="formData.hasEv" :value="true" class="form-radio" name="hasEv">
                    <span class="ml-2">Yes</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" v-model="formData.hasEv" :value="false" class="form-radio" name="hasEv">
                    <span class="ml-2">No</span>
                </label>
            </div>
        </div>
        <div v-if="formData.hasEv">
            <div class="mt-4">
                <label for="evBrand" class="block text-gray-700 text-sm font-bold mb-2">Electric vehicle brand:</label>
                <select id="evBrand" v-model="formData.evBrandId" @change="fetchEvModels(formData.evBrandId)" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="evModel" class="block text-gray-700 text-sm font-bold mb-2">Electric vehicle model:</label>
                <select id="evModel" v-model="formData.evModel" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option v-for="model in evModels" :value="model.id">{{ model.name }}</option>
                </select>
            </div>
        </div>


        <div class="mt-4">
            <label for="chargingBrand" class="block text-gray-700 text-sm font-bold mb-2">Desired charging station brand:</label>
            <select id="chargingBrand" v-model="formData.providerCompany" @change="fetchChargerType(formData.providerCompany)" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option v-for="provider in providerCompanies" :value="provider.id">{{ provider.name }}</option>
            </select>
        </div>
        <div class="mt-4">
            <label for="power" class="block text-gray-700 text-sm font-bold mb-2">Desired charging station type:</label>
            <select id="power" v-model="formData.chargerType" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option v-for="type in chargerTypes" :value="type.id">{{ type.name }}</option>
            </select>
        </div>



        <div class="flex items-center justify-between mt-4">
            <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Submit
            </button>
        </div>
    </form>
</div>
</div>
</template>
<script >
import axios from "axios";
import {useUserStore} from "../store/user";

export default {
    name: 'Survey',
    props: {
        clickedPosition: {
            type: Object,
            default: () => ({ lat: null, lng: null })
        }
    },
    data() {
        return {
            formData: {
                radius: '',
                hasEv: '',
                evBrandId: '',
                evModel: '',
                providerCompany: '',
                chargerType: '',
                latitude: '',
                longitude: ''
            },
            validMarkers: [],
            //fetch from backend
            // one to many
            brands: [],
            evModels: [],
            // many to many
            providerCompanies: [],
            chargerTypes: [],
            radiusNums: [1, 5, 10, 20],
        }
    },
    watch: {
        clickedPosition: {
            handler(newVal) {
                if (newVal && newVal.lat != null && newVal.lng != null) {
                    this.formData.latitude = newVal.lat;
                    this.formData.longitude = newVal.lng;
                }
            },
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            // get data from backend
            this.fetchBrands();
            this.fetchProviderCompanies();
        },
        submitForm() {
            const userStore = useUserStore();
            console.log('Form Data:', this.formData);
            // submit form
            this.$axios.post('/backend/api/v1/public/survey', this.formData)
                .then(response => {
                    console.log('Survey form submitted');
                    alert('Survey form submitted');
                    console.log(response);
                    this.$router.push('/');
                })
                .catch(error => {
                    console.error('Error submitting survey form:', error);
                    alert('Error submitting survey form');
                });
        },
        async fetchBrands() {
            try {
                const response = await this.$axios.get('/backend/api/v1/public/brands');
                this.brands = response.data;
            } catch (error) {
                console.error('Error fetching brands:', error);
            }
        },
        async fetchEvModels(brandId) {
            try {
                const response = await this.$axios.get(`/backend/api/v1/public/vehicle-models/${brandId}`);
                this.evModels = response.data;
            } catch (error) {
                console.error('Error fetching vehicle models:', error);
            }
        },
        async fetchProviderCompanies() {
            try {
                const response = await this.$axios.get('/backend/api/v1/public/provider-company');
                this.providerCompanies = response.data;
            } catch (error) {
                console.error('Error fetching charging brands:', error);
            }
        },
        async fetchChargerType(chargerTypeId) {
            try {
                const response = await this.$axios.get(`/backend/api/v1/public/charger-types/${chargerTypeId}`);
                this.chargerTypes = response.data;
            } catch (error) {
                console.error('Error fetching charger types:', error);
            }
        }
    }
}
</script>
