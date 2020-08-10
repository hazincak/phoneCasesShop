require('./bootstrap');

import  BootstrapVue  from 'bootstrap-vue';

import router from "./routes";
import VueRouter from "vue-router";

import Navbar from "./components/Navbar"
import Sidebar from "./components/Sidebar"
import Footer from "./components/Footer";

import Index from "./Index";
import Title from "./pages/homePageComponents/Title";
import Cards from "./pages/homePageComponents/Cards";
import Shop from "./pages/homePageComponents/Shop"


window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(BootstrapVue);

Vue.component("navbar", Navbar);
Vue.component("sidebar", Sidebar);
Vue.component("section-footer", Footer);

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
