import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import DisplayProduct from "./pages/DisplayProduct";

import Register from "./pages/authComponents/Register";

import Admin from "./pages/Admin";

import Products from "./pages/adminComponents/adminPages/Products";
import ProductsDashboard from "./pages/adminComponents/adminPages/ProductsDashboard";
import UpdateProduct from "./pages/adminComponents/adminPages/UpdateProduct";


import ColorsAndMaterials from "./pages/adminComponents/adminPages/ColorsAndMaterials";
import ColorsAndMaterialsDashboard from "./pages/adminComponents/adminPages/ColorsAndMaterialsDashboard";

import Brands from "./pages/adminComponents/adminPages/Brands";
import BrandsDashboard from "./pages/adminComponents/adminPages/BrandsDashboard";
import BrandUpdate from "./pages/adminComponents/adminPages/BrandUpdate";

import Categories from "./pages/adminComponents/adminPages/Categories";
import CategoriesDashboard from "./pages/adminComponents/adminPages/CategoriesDashboard";
import CategoryUpdate from "./pages/adminComponents/adminPages/CategoryUpdate";

import NotAuthorised from "./shared/components/NotAuthorised";
import store from "./store";




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
        path:"/kategoria-:categoryId-znacka-:brandId-model-:modelId",
        component: Shop,
        name: 'obchod-vyber',
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

    {
        path: "/registracia",
        component: Register,
        name: "register",
    },

    {
        path: "/admin",
        component: Admin,
        name: "admin",
        
        children: [
            {
                path: "kategorie",
                name: "categories",
                component: Categories,
                
                  children:[
                    {
                        path: "kategorie-nahlad",
                        name: "CategoriesDashboard",
                        component: CategoriesDashboard,
                        
                    },
                    {
                        path: "aktualizovat-kategorie/:id",
                        name: "categoryUpdate",
                        component: CategoryUpdate,
                    },
                  ]
              },
              {
                path: "farby-a-materialy",
                name: "colorsAndCategories",
                component: ColorsAndMaterials,
                    children:[
                        {
                            path: "farby-a-materialy-nadhlad",
                            name: "ColorsAndMaterialsDashboard",
                            component: ColorsAndMaterialsDashboard
                        }
                    ]
              },

            {
                path: "znacky",
                name: "brands",
                component: Brands,

                children:[
                    {
                        path: "znacky-nahlad",
                        name: "BrandsDashboard",
                        component: BrandsDashboard,
                    },
                    {
                        path: "aktualizovat-znacku/:id",
                        name: "brandUpdate",
                        component: BrandUpdate,
                    }
                ]
            },
            {
              path: "produkty",
              name: "products",
              component: Products,

                children:[
                    {
                        path: "vsetky-produkty",
                        name: "ProductsDashboard",
                        component:ProductsDashboard,
                    },
                    {
                        path: "pridat",
                        name: "updateProduct",
                        component: UpdateProduct,
                    }
                ]
            },
          ],
          beforeEnter: (to, from, next) => {
            if(store.state.isAdmin){
                next()
            }else{
                next({name: "not-authorised"})
            }
        },
   
    
    },
    {
        path: "/pristup-zamietnuty",
        name: "not-authorised",
        component: NotAuthorised
    }


];

const router = new VueRouter({
    routes,
    mode: "history",

    
});

export default router;