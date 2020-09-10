import VueRouter from "vue-router";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Basket from "./pages/Basket";
import DisplayProduct from "./pages/DisplayProduct";

import Register from "./pages/authComponents/Register";

import Admin from "./pages/Admin";
import Products from "./pages/adminComponents/adminPages/Products";
import AddProduct from "./pages/adminComponents/adminPages/AddProduct";
import UpdateProduct from "./pages/adminComponents/adminPages/UpdateProduct";
import Users from "./pages/adminComponents/adminPages/Users";

import Categories from "./pages/adminComponents/adminPages/Categories";
import UpdateCategory from "./pages/adminComponents/adminPages/UpdateCategory";




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
                {name: 'Obchod',link: '/obchod'},
                {name: 'Všetky produkty'}
            ]
        }
    },

    {
        path:"/obaly-na-:model",
        component: Shop,
        name: 'obchod-model-obaly',
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Obchod', link: '/obchod'},
                {name:  'Obaly na mobil'}
            ]
        }
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

    {
        path: "/registracia",
        component: Register,
        name: "register",
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Registrácia'}
            ]
        }
    },

    {
        path: "/admin",
        component: Admin,
        name: "admin",
        meta:{
            breadcrumb: [
                {name: 'Domov', link: '/'},
                {name: 'Admin'}
            ],
        },
        children: [
            {
                path: "kategorie",
                name: "categories",
                component: Categories,
  
                  children:[
                      {
                      path: "aktualizovat",
                      name: "updateCategory",
                      component: UpdateCategory,
                      },
                  ]
              },
            {
              path: "produkty",
              name: "products",
              component: Products,

                children:[
                    {
                    path: "pridat",
                    name: "addProduct",
                    component: AddProduct,
                    },
                    {
                    path: "pridat",
                    name: "updateProduct",
                    component: UpdateProduct,
                    }
                ]
            },
            {
                path: "uzivatelia",
                name: "users",
                component: Users
              },
          ]

    
    },


];

const router = new VueRouter({
    routes,
    mode: "history",

    
});


// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth && record.meta.requiresAdmin)) {
//       if (isUserAdmin) {
//         next({
//           path: '/admin',
//           query: { redirect: to.fullPath }
//         })
//       } else {
//         next({
//             path: 'home',
//         })
//       }
//     } else {
//       next() // make sure to always call next()!
//     }
//   })

export default router;