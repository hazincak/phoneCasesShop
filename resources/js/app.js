require('./bootstrap');

import  BootstrapVue  from 'bootstrap-vue';

import router from "./routes";
import VueRouter from "vue-router";

import Index from "./Index";

import Navbar from "./components/Navbar"
import Sidebar from "./components/Sidebar"
import Footer from "./components/Footer";


import Title from "./pages/homePageComponents/Title";
import Cards from "./pages/homePageComponents/Cards";
import Shop from "./pages/homePageComponents/Shop";
import Press from "./pages/homePageComponents/Press";




window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(BootstrapVue);

Vue.component("navbar", Navbar);
Vue.component("sidebar", Sidebar);
Vue.component("section-footer", Footer);

Vue.component("section-title", Title);
Vue.component("section-cards", Cards);
Vue.component("section-shop", Shop);
Vue.component("section-press", Press);



const app = new Vue({
    el: '#app',
    router,
    components:{
        "index": Index
    }
});
