<template>
    <div class="container-fluid">
            <div v-if="loading">
                Data is loading...
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-md-2 sm-12">
                        <side-bar @menu-option = "selectedOption = $event"></side-bar>
                    </div>
                    <div class="col-md-10 sm-12">
                        <breadcrumb></breadcrumb>
                        <div class="row mb-4">
                            <div v-for="product in products.data" :key="product.id" class="col-md-3 xs-12"><product-item-card v-bind:product="product"></product-item-card></div>
                        </div>
                        <pagination :data="products" align='center' @pagination-change-page="getResults">
 
                        </pagination>
                        
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import ProductItemCard from "./shopPageComponents/ProductCard";
import SideBar from "./shopPageComponents/Sidebar";
export default {


    components:{
        ProductItemCard, SideBar
    },

    data(){
        return{
            products: {},
            loading:false,
            selectedOption: null,
        }
    },

    created(){
        this.getResults();
    },


    methods:{
        getResults(page = 1){
             this.loading = true
         
                axios.get(`api/obchod/produkty?page=` + page)
                .then(response => {
                    this.products = response.data;
                    this.loading=false;
                });

        }
    }

    // created(){
    //     this.loading = true

    //     const request = axios.get("api/obchod/produkty?page=" +this.page)
    //     .then(response => {
    //     this.products = response.data
    //     this.loading = false;
    //     });
    // },
}
</script>