import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import DisplayProduct from "./pages/DisplayProduct.vue";

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
        path:"/obchod/produkty/:brand",
        component: Shop,
        name: 'obchod-znacka'
    },

    {
        path:"/obchod/produkty/na-:model",
        component: Shop,
        name: 'obchod-model'
    },

    {
        path:"/obchod/produkty/obaly-na-:brand",
        component: Shop,
        name: 'obchod-znacka-obaly'
    },

    {
        path:"/obaly-na-:model",
        component: Shop,
        name: 'obchod-model-obaly',
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Obchod', link: '/obchod'},
                {name: 'Kryty na mobil'}
            ]
        }
    },

    {
        path:"/obchod/produkty/ochranne-skla-na-:brand",
        component: Shop,
        name: 'obchod-znacka-ochranne-skla'
    },

    {
        path:"/obchod/produkty/ochranne-skla-na-:model",
        component: Shop,
        name: 'obchod-model-ochranne-skla'
    },
    {
        path:"/obchod/produkty/prislusenstvo-na-:brand",
        component: Shop,
        name: 'obchod-znacka-prislusenstvo'
    },

    {
        path:"/obchod/produkty/prislusenstvo-na-:model",
        component: Shop,
        name: 'obchod-model-prislusenstvo'
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