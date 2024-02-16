import { createApp } from 'vue';
const app = createApp({});
import TestZone from './components/test.vue';

app.component('zone-vue-component',TestZone);
app.mount("#zone_app");
