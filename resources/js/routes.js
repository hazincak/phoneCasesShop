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
            breadcrumb: 'domov'
        }
    },
    {
        path: "/obchod",
        component: Shop,
        name: "obchod",
        meta: {
            breadcrumb: $route => `route params id: ${$route.id}`
          }
    },
    {
        path: "/produkt/:id",
        component: DisplayProduct,
        name: "produkt",
        meta: {
            breadcrumb() {
              const { name } = this.$route;
  
              return {
                label: name,
                parent: 'domov'
              };
            }
          }

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