import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";

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
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;