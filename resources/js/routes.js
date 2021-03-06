import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import SuccessfulCheckout from "./components/checkoutComponents/successCheckout";
import DisplayProduct from "./pages/DisplayProduct";
import TradingTerms from "./pages/TradingTerms";
import Gdpr from "./pages/GDPR";
import RulesOfReturns from "./pages/RulesOfReturns";

import Register from "./components/authComponents/Register";

import Admin from "./pages/Admin";

import Products from "./components/adminComponents/adminPages/Products";
import ProductsDashboard from "./components/adminComponents/adminPages/ProductsDashboard";
import UpdateProduct from "./components/adminComponents/adminPages/UpdateProduct";

import ColorsAndMaterials from "./components/adminComponents/adminPages/ColorsAndMaterials.vue";
import ColorsAndMaterialsDashboard from "./components/adminComponents/adminPages/ColorsAndMaterialsDashboard";

import Brands from "./components/adminComponents/adminPages/Brands";
import BrandsDashboard from "./components/adminComponents/adminPages/BrandsDashboard";
import BrandUpdate from "./components/adminComponents/adminPages/BrandUpdate";

import Categories from "./components/adminComponents/adminPages/Categories";
import CategoriesDashboard from "./components/adminComponents/adminPages/CategoriesDashboard";
import CategoryUpdate from "./components/adminComponents/adminPages/CategoryUpdate";

import ManageCarousel from "./components/adminComponents/adminPages/ManageCarousel";

import Orders from "./components/adminComponents/adminPages/Orders";
import OrdersDashboard from "./components/adminComponents/adminPages/OrdersDashboard";

import ReturnAndRefundPolicies from "./components/adminComponents/adminPages/ReturnAndRefundPolicyDashboard";
import TermsAndConditions from "./components/adminComponents/adminPages/TradingTermsDashboard";
import GeneralDataProtectionRegulationRules from "./components/adminComponents/adminPages/GdprDashboard";

import NotAuthorised from "./shared/components/NotAuthorised";
import store from "./store";




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
        path:"/category-:categoryId-brand-:brandId-model-:modelId",
        component: Shop,
        name: 'shop-selection',
    },
    {
        path: "/produkt/:id",
        component: DisplayProduct,
        name: "product",
    },
    {
        path: "/shopping-cart",
        component: Basket,
        name: "cart",
    },
    {
        path:"/thank-you-for-your-order",
        component: SuccessfulCheckout,
        name: 'successfulCheckout',
    },
    {
        path: "/registration",
        component: Register,
        name: "register",
    },

    {
        path: "/trading-terms",
        component: TradingTerms,
        name: "trading-terms",
    },

    {
        path: "/gdpr",
        component: Gdpr,
        name: "gdpr",
    },

    {
        path: "/rules-of-returns",
        component: RulesOfReturns,
        name: "rules-of-returns",
    },



    {
        path: "/admin",
        component: Admin,
        name: "admin",

        beforeEnter: (to, from, next) => {
            if(store.state.isAdmin){
                next()
            }else{
                next({name: "not-authorised"})
            }
        },
        beforeUpdate(to, from, next) {
            if(store.state.isAdmin){
                next()
            }else{
                next({name: "not-authorised"})
            }
        },

        children: [
            {
                path: "categories",
                name: "categories",
                component: Categories,

                  children:[
                    {
                        path: "kategorie-nahlad",
                        name: "CategoriesDashboard",
                        component: CategoriesDashboard,

                    },
                    {
                        path: "update-category/:id",
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
                path: "brand",
                name: "brands",
                component: Brands,

                children:[
                    {
                        path: "brand-nahlad",
                        name: "BrandsDashboard",
                        component: BrandsDashboard,
                    },
                    {
                        path: "update-brand/:id",
                        name: "brandUpdate",
                        component: BrandUpdate,
                    }
                ]
            },
            {
              path: "products",
              name: "products",
              component: Products,

                children:[
                    {
                        path: "all-products",
                        name: "ProductsDashboard",
                        component:ProductsDashboard,
                    },
                    {
                        path: "aktualizovat-product/:id",
                        name: "updateProduct",
                        component: UpdateProduct,
                    }
                ]
            },

            {
                path: "orders",
                name: "orders",
                component: Orders,

                    children:[
                        {
                            path: "orders-dashboard",
                            name: "OrdersDashboard",
                            component: OrdersDashboard
                        },
                    ]
            },



            {
                path: "manage-carousel",
                name: 'ManageCarousel',
                component: ManageCarousel
            },

            {
                path: "manage-return-and-refund-policy",
                name: 'ReturnAndRefundPolicy',
                component: ReturnAndRefundPolicies
            },

            {
                path: "manage-terms-and-conditions",
                name: 'TermsAndConditions',
                component: TermsAndConditions
            },

            {
                path: "manage-gdpr",
                name: 'Gdpr',
                component: GeneralDataProtectionRegulationRules
            }
          ],
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
