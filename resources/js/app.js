require('./bootstrap');

import VueRouter from "vue-router";
import Vuex from "vuex";
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap';

import Index from "./Index";
import router from "./routes";

import moment from "moment";

import Navbar from "./shared/components/Navbar";
import Footer from "./shared/components/Footer";

import ValidationErrors from "./shared/components/ValidationErrors";

import FlashMessage from '@smartweb/vue-flash-message';
import {SpringSpinner} from 'epic-spinners'

import StoreDefinition from './store';



window.Vue = require('vue');

//Import Froala Editor
import 'froala-editor/js/plugins.pkgd.min.js';
//Import third party plugins
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';
// Import Froala Editor css files.
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)
Vue.config.productionTip = false

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
Vue.filter("shortened", function(string){
    let shortenedString = string.slice(0, 80)
    return shortenedString + "...";
})


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
