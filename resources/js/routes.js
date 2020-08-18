import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import DisplayProduct from "./pages/shopPageComponents/DisplayProduct.vue";

const routes = [
    {
        path: "/",
        component: Home,
        name: "domov",
        meta:{
            breadcrumb: [
                {name: 'domov'}
            ]
        }
    },
    {
        path: "/obchod",
        component: Shop,
        name: "obchod",
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Obchod'}
            ]
        }
    },
    {
        path: "/produkt/:id",
        component: DisplayProduct,
        name: "produkt",
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Obchod', link: '/obchod'},
                {name: 'Produkt'}
            ]
        }
    },
    {
        path: "/kosik",
        component: Basket,
        name: "kosik",
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Obchod', link: 'obchod'},
                {name: 'Košík'}
            ]
        }
    },


];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;