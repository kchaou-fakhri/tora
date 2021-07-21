import router from "./router/index";
import VueRouter from 'vue-router'
import '@fortawesome/fontawesome-free/css/all.css'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'



require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter)
Vue.use(BootstrapVue)
const axios = require('axios').default;


Vue.component('mainapp', require('./components/Main.vue').default);




const app = new Vue({
    el: '#app',
    router
});
