<template>
    <div class="container-fluid shop-section">
            <div v-if="loading" >
           <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
            />
            </div>
            <div class="row" v-else>
                
                        <side-bar :isActive = "isActive" v-on:sidebar-change = "changeSideBarStatus($event)"></side-bar>
                    
                    <div class="col">
                        <div class="row">
                        <div class="sidebar__toggler" @click="isActive = !isActive">Menu <i class="fas fa-bars"></i></div>
                        <breadcrumb></breadcrumb>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                            <div v-for="product in products.data" :key="product.id"><product-item-card v-bind:product="product"></product-item-card></div>
                        </div>
                        <pagination :data="products" align='center' @pagination-change-page="getResults">
 
                        </pagination>
                        
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

            isActive:false,
            products: {},
            loading:false,
            
        }
    },

    created(){
        this.getResults();
    },


    methods:{
        getResults(page = 1){
             this.loading = true
            // this.products = {}
                axios.get(`api${this.$route.path}?page=` + page)
                .then(response => {
                    this.products = response.data;
                    this.loading=false;
                });
        },
        changeSideBarStatus(status){
            this.isActive =  status
        }
       
    }


}
</script>