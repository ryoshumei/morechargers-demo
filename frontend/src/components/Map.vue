<template>
<div>
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
        style="height: 87vh"
        @click="handleMapClick"
    >
        <GMapMarker
            v-for="(marker, index) in validMarkers"
            :key="index"
            :position="{lat: marker.lat, lng: marker.lng}"
        />
        <GMapMarker
            v-if="clickedPosition"
            :position="clickedPosition"
        />
    </GMapMap>
</div>
</template>

<script >
export default {
    name: 'Map',
    props: {
        markers: Array // receive markers from parent component
    },
    data() {
        return {
            center: { lat: 35.6895, lng: 139.6917 },//tokyo
            clickedPosition: null,
            validMarkers: [],
        }
    },
    watch: {
        markers: {
            immediate: true,
            handler(newVal) {
                this.validMarkers = this.convertToValidCoordinates(newVal);
            }
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
            // emit clicked position to parent component
            this.$emit("clickedPositionEvent", this.clickedPosition);
            console.log('clickedPositionEvent emitted');
        },
        convertToValidCoordinates(data) {
            console.log(data);
            // convert string coordinates to number
            return data.map(item => ({
                lat: Number(item.latitude),
                lng: Number(item.longitude),
            }))},
    }
}
</script>
