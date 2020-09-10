require('./bootstrap');

import VueRouter from "vue-router";
import Vuex from "vuex";

import Index from "./Index";
import router from "./routes";

import moment from "moment";

import Navbar from "./components/Navbar";
import BreadCrumb from "./components/BreadCrumbs.vue";
import Footer from "./components/Footer";

import ValidationErrors from "./shared/components/ValidationErrors";

import {SpringSpinner} from 'epic-spinners'

import StoreDefinition from './store';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component("navbar", Navbar);
Vue.component("breadcrumb", BreadCrumb);
Vue.component("section-footer", Footer);

Vue.component("v-errors", ValidationErrors);

Vue.component('atom-spinner', SpringSpinner);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.filter("fromNow", value => moment(value).fromNow());

const store = new Vuex.Store(StoreDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if(401 === error.response.status){
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);



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
        this.$store.dispatch("loadUser");
   
    }
});
