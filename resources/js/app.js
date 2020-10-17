require('./bootstrap');

import VueRouter from "vue-router";
import Vuex from "vuex";
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap';

import Index from "./Index";
import router from "./routes";

import moment from "moment";

import Navbar from "./components/Navbar";
import Footer from "./components/Footer";

import ValidationErrors from "./shared/components/ValidationErrors";

import FlashMessage from '@smartweb/vue-flash-message';
import {SpringSpinner} from 'epic-spinners'

import StoreDefinition from './store';

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Vuex);


Vue.component("navbar", Navbar);
Vue.component("section-footer", Footer);

Vue.component("v-errors", ValidationErrors);


Vue.use(FlashMessage);
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

    async beforeCreate(){
        this.$store.dispatch("loadStoredState");
        this.$store.dispatch("loadUser");
   
    }
});
