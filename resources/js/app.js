require('./bootstrap');

import  BootstrapVue  from 'bootstrap-vue';

import router from "./routes";
import VueRouter from "vue-router";

import Index from "./Index";

import Navbar from "./components/Navbar"
import Sidebar from "./components/Sidebar"
import Footer from "./components/Footer";


import Title from "./pages/homePageComponents/Title";
import HomeCard from "./pages/homePageComponents/HomeCards";
import ShopCard from "./pages/shopPageComponents/ProductItemCard"






window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(BootstrapVue);

Vue.component("navbar", Navbar);
Vue.component("sidebar", Sidebar);
Vue.component("section-footer", Footer);

Vue.component("section-title", Title);
Vue.component("home-section-cards", HomeCard);

Vue.component("product-item-card", ShopCard);




const app = new Vue({
    el: '#app',
    router,
    components:{
        "index": Index
    }
});
