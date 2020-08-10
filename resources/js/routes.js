import VueRouter from "vue-router";
import Home from "./pages/Domov";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
    },
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;