import {createApp} from "vue";

const app = createApp({});

import TestComponent from './components/TestComponent.vue';
app.component('test-component',TestComponent)

app.mount("#test_zone");