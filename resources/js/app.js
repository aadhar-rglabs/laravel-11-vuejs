import './bootstrap';
import '../../public/assets/css/adminlte.min.css'
import '../../public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'
import '../../public/assets/plugins/fontawesome-free/css/all.min.css'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue'; 
import router from './router'
 
import CompaniesIndex from '@/components/companies/CompaniesIndex.vue';
 
createApp({
    components: {
        CompaniesIndex
    }
}).use(router).mount('#app')

