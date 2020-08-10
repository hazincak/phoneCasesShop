require('./bootstrap');

import router from "./routes";
import VueRouter from "vue-router";
import Index from "./Index";
import Title from "./pages/components/Title";
import Cards from "./pages/components/Cards";


window.Vue = require('vue');

Vue.use(VueRouter);

Vue.component("section-title", Title);
Vue.component("section-cards", Cards);

const app = new Vue({
    el: '#app',
    router,
    components:{
        "index": Index
    }
});
