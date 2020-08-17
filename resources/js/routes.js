import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import DisplayProduct from "./pages/shopPageComponents/DisplayProduct.vue";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
    },
    {
        path: "/obchod",
        component: Shop,
        name: "shop",
    },
    {
        path: "/produkt/:brand/:title",
        component: DisplayProduct,
        name: "product"

    },
    {
        path: "/kosik",
        component: Basket,
        name: "basket",
    },


];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;