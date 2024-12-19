<template>
  <div style="height: 100%; width: 100%;">
    <l-map
      v-model="zoom"
      v-model:zoom="zoom"
      :center="[lat,lng]"
    >
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      ></l-tile-layer>
      <l-marker :lat-lng="[lat,lng]" draggable @moveend="getLatLng">
        <l-tooltip>
          Change this Marker to your location
        </l-tooltip>
      </l-marker>
    </l-map>
  </div>
</template>
<script>
import {
  LMap,
  LIcon,
  LTileLayer,
  LMarker,
  LControlLayers,
  LTooltip,
  LPopup,
  LPolyline,
  LPolygon,
  LRectangle,
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";

  export default {
  components: {
    LMap,
    LIcon,
    LTileLayer,
    LMarker,
    LControlLayers,
    LTooltip,
    LPopup,
    LPolyline,
    LPolygon,
    LRectangle,
  },
  props: {
    lat: {
      type: Number,
      required: true
    },
    lng: {
      type: Number,
      required:true
    }
  },
  data() {
    return {
      zoom: 15,
      iconWidth: 25,
      iconHeight: 40,
    };
  },
  methods: {
    getLatLng(event) {
      const {lat,lng} = event.target.getLatLng();
      this.$emit('update-location', { lat, lng });
    }
  },
};
</script>