require('./bootstrap');

import  BootstrapVue  from 'bootstrap-vue';

import router from "./routes";
import VueRouter from "vue-router";

import Navbar from "./components/Navbar"

import Index from "./Index";
import Title from "./pages/components/Title";
import Cards from "./pages/components/Cards";
import Shop from "./pages/components/Shop"


window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(BootstrapVue);

Vue.component("navbar", Navbar);

Vue.component("section-title", Title);
Vue.component("section-cards", Cards);
Vue.component("section-shop", Shop);

const app = new Vue({
    el: '#app',
    router,
    components:{
        "index": Index
    }
});
