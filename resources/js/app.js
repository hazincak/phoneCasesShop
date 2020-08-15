require('./bootstrap');

import VueRouter from "vue-router";
import Vuex from "vuex";
import Index from "./Index";
import router from "./routes";


import Navbar from "./components/Navbar";
import BreadCrumbs from "./components/BreadCrumbs.vue";
import Footer from "./components/Footer";

import StoreDefinition from './store';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component("navbar", Navbar);
Vue.component("bread-crumbs", BreadCrumbs);
Vue.component("section-footer", Footer);

const store = new Vuex.Store(StoreDefinition);


const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
        "index": Index
    }
});
