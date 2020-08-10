import VueRouter from "vue-router";
import Domov from "./pages/Domov";

const routes = [
    {
        path: "/",
        component: Domov,
        name: "home",
    },
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;