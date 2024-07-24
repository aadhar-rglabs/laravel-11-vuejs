import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue'; 
import router from './router'
 
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue';
import ChatComponent from './components/ChatComponent.vue';
 
createApp({
    components: {
        CompaniesIndex,
        ChatComponent
    }
}).use(router).mount('#app')
