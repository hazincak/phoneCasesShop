require('./bootstrap');

import router from "./routes";
import VueRouter from "vue-router";

import Index from "./Index";

import Navbar from "./components/Navbar";
import BreadCrumbs from "./components/BreadCrumbs.vue";
import Footer from "./components/Footer";


window.Vue = require('vue');

Vue.use(VueRouter);


Vue.component("navbar", Navbar);
Vue.component("bread-crumbs", BreadCrumbs);
Vue.component("section-footer", Footer);

const app = new Vue({
    el: '#app',
    router,
    components:{
        "index": Index
    }
});
