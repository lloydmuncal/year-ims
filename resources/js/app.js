import './bootstrap';
import '../css/app.css'

import { createApp } from 'vue'
import App from './components/templates/App.vue'
import { useUserStore } from './Store/mainStore.js'

import VueApexCharts from "vue3-apexcharts";
//Router
import router  from './router.js'

//pinia
import { createPinia } from 'pinia'


// Access the API URL from the .env file
const apiUrl = import.meta.env.VITE_APP_URL;

// Now you can use apiUrl in your app
console.log(apiUrl);


const pinia = createPinia()


const app = createApp(App)
app.use(pinia)
app.use(router)
app.use(VueApexCharts);
app.provide('apiUrl', apiUrl);



const userStore = useUserStore();

userStore.initializeUser();
userStore.getAvatar();




app.mount('#app')
