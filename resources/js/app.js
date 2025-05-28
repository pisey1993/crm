import { createApp } from 'vue';
import router from './router';
import App from './components/App.vue';

import './bootstrap'; // Make sure this line exists and is uncommented

createApp(App)
    .use(router)
    .mount('#app');
