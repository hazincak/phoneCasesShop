require('./bootstrap');

import VueRouter from "vue-router";
import Vuex from "vuex";


import Index from "./Index";
import router from "./routes";

import Navbar from "./components/Navbar";
import BreadCrumb from "./components/BreadCrumbs.vue";
import Footer from "./components/Footer";

import {SpringSpinner} from 'epic-spinners'

import StoreDefinition from './store';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component("navbar", Navbar);
Vue.component("breadcrumb", BreadCrumb);
Vue.component("section-footer", Footer);

Vue.component('atom-spinner', SpringSpinner);
Vue.component('pagination', require('laravel-vue-pagination'));

const store = new Vuex.Store(StoreDefinition);


const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
        "index": Index
    },

    watch: {
        'route' () {
            this.breadCrumbList - this.$route.meta.BreadCrumb
        }
    },

    async beforeCreate(){
        this.$store.dispatch("loadStoredState");

        // await axios.get('/sanctum/csrf-cookie');
        // await axios.post("/login", {
        //     email: 	'jtillman@example.org',
        //     password: 'password'
        // });

        // await axios.get('/user');
    }
});
