<template>
    <div class="container-fluid shop-section">
            <div v-if="loading" >
                 <atom-spinner class="my-center"
                :animation-duration="1000"
                :size="80"
                :color="'#086972'"
            />
            </div>
            <!-- loading spinner -->
            <div class="row" v-else>
                
                        <side-bar :isActive = "isActive" v-on:sidebar-change = "changeSideBarStatus($event)"></side-bar>
                    
                <div class="col">
                        <div class="d-flex flex-row">
                            <div>
                                <div class="sidebar__toggler" @click="isActive = !isActive">Menu <i class="fas fa-bars"></i></div>
                            </div>
                            <div class="mr-auto">
                                <b-breadcrumb>
                                <router-link class="breadcrumb-link" :to="{name: 'domov'}"> <i class="fas fa-home"></i> Domov/</router-link>
                                <router-link class="breadcrumb-link" :to="{name: 'obchod'}"> Obchod/</router-link>
                                <div v-if="this.$route.path == '/obchod'">
                                    <b-breadcrumb-item active>Vsetky produkty</b-breadcrumb-item>
                                </div>
                                <div v-else>
                                    <b-breadcrumb-item active>{{products.data[0].category.category_name}}/{{products.data[0].brand.brand_name}}/{{products.data[0].model.model_name}}</b-breadcrumb-item>
                                </div>
                                </b-breadcrumb>
                            </div>
                                    <div class="row" style="padding: 0.75rem 0rem">
                                      
                                            <form class="form-inline">
                                                <label for="productsQuantity" class="mr-2">Počet zobrazených: </label>
                                                <select 
                                                class="form-control mr-5"
                                                name="productsQuantity"
                                                v-model="perPage"
                                                >
                                                  <option value = 8>8</option>
                                                  <option value = 12>12</option>
                                                  <option value = 16>16</option>
                                                  <option value = 32>32</option>
                                                </select>
                                            
                                     
                               
                                                <label for="orderBy">
                                                    <span class="d-inline"  v-if="orderBy != 'id'">
                                                        <span v-if="order == 'asc'">
                                                            <i @click="order = 'desc'"  class="fas fa-sort-amount-down-alt mr-2 orderBy-icon"></i> Vzostupne
                                                        </span>
                                                        <span class="d-inline" v-if="order == 'desc'">
                                                            <i @click="order = 'asc'" class="fas fa-sort-amount-down mr-2 orderBy-icon"></i> Zostupne
                                                        </span> 
                                                    </span>
                                                </label>
                                                <select 
                                                    class="form-control ml-1 mr-3"
                                                    v-model="orderBy"
                                                    name="orderBy"
                                                    >
                                                    <option value= 'id' selected disabled>Zoradiť produkty</option>
                                                  <option value="price">Zoradiť podľa ceny</option>
                                                  <option value="created_at">Zoradiť podľa dátumu pridania</option>
                                                </select>
                                            </form>
                                    </div>
                        </div>
                        <!--Sorting navigation row  -->
                        <hr>
                                              
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 p-5">
                            <div v-for="product in products.data" :key="product.id"><product-item-card v-bind:product="product"></product-item-card></div>
                        </div>
                        <pagination :data="products" align='center' @pagination-change-page="getResults"></pagination>
                        
                </div>
                <!-- col row -->
             </div>
             <!-- v-else row -->
    </div>
    <!-- container row -->
            
   
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
            perPage: 16,
            orderBy: 'id',
            order: 'asc',

        }
    },
  
    created(){
        this.getResults();
    },

    watch:{
        perPage: function(){
            this.getResults() 
        },
        orderBy: function(){
            this.getResults()
        },
        order: function(){
            this.getResults()
        }
    },

    methods:{
       
        getResults(page = 1){
             this.loading = true
                axios.get(`api${this.$route.path}?page=${page}&perPage=${this.perPage}&orderBy=${this.orderBy}&order=${this.order}` )
                // axios.get(`api${this.$route.path}?page=${page}`)
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

<style scoped>
.orderBy-icon{
    color: #01a9b4;
    font-size: 2rem;
    display: inline;
}

.orderBy-icon:hover{
    transform: scale(1.1);
    color: #086972;
}
</style>