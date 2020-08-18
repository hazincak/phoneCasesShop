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
    },
    {
        path: "/obchod",
        component: Shop,
        name: "obchod",
    },
    {
        path: "/produkt/:id",
        component: DisplayProduct,
        name: "produkt",
    },
    {
        path: "/kosik",
        component: Basket,
        name: "kosik",
    },


];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;