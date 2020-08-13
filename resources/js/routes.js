import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import Product from "./pages/shopPageComponents/DisplayProduct.vue";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
    },
    {
        path: "/shop",
        component: Shop,
        name: "shop",
    },
    {
        path: "/product/:id",
        component: Product,
        name: "product"

    },
    {
        path: "/basket",
        component: Basket,
        name: "basket",
    },


];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;