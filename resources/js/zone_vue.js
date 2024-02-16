import {createApp} from "vue";

const app = createApp({});

import ZoneComponent from './components/ZoneComponent.vue';
import ZoneNewComponent from './components/ZoneNewComponent.vue';

import ZoneV2Component from './components/ZoneV2Component.vue';

import Multiselect from 'vue-multiselect'

app.component('zone-component',ZoneComponent)
app.component('zone-new-component',ZoneNewComponent)
app.component('zone-v2-component',ZoneV2Component)
app.component('multiselect',Multiselect)


app.mount("#zone_app");