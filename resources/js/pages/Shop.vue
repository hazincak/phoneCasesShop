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
                        <side-bar></side-bar>
                <div class="col p-5">
                         <div class="d-flex">
                                <div v-b-toggle.sidebar-backdrop class="sidebar__toggler"><i class="fas fa-bars"></i>&nbsp;MENU</div>

                            <div class="align-self-center">
                                <b-breadcrumb>
                                <router-link class="breadcrumb-link" :to="{name: 'home'}"> <i class="fas fa-home"></i> Home/</router-link>
                                <router-link class="breadcrumb-link" :to="{name: 'shop'}"> Shop/</router-link>
                                <div v-if="this.$route.path == '/shop'">
                                    <b-breadcrumb-item active>All products</b-breadcrumb-item>
                                </div>
                                <div v-else>
                                    <b-breadcrumb-item active>{{products.data[0].category_name}}/{{products.data[0].brand_name}}/{{products.data[0].model_name}}</b-breadcrumb-item>
                                </div>
                                </b-breadcrumb>
                            </div>
                        </div>
                        <!--Sorting navigation row  -->
                         <div class="d-flex justify-content-between">

                                <form class="form-inline">
                                    <label for="productsQuantity" class="mr-2">Displaying: </label>
                                    <select
                                    class="form-control"
                                    name="productsQuantity"
                                    v-model="perPage"
                                    >
                                      <option value = 8>8</option>
                                      <option value = 12>12</option>
                                      <option value = 16>16</option>
                                      <option value = 32>32</option>
                                    </select>
                                </form>

                                <form class="form-inline align-self-end">
                                    <label for="orderBy">
                                        <span class="d-inline mr-2"  v-if="orderBy != 'id'">
                                            <span v-if="order == 'asc'">
                                                <i @click="order = 'desc'"  class="fas fa-sort-amount-down-alt mr-2 orderBy-icon"></i> Descending
                                            </span>
                                            <span class="d-inline" v-if="order == 'desc'">
                                                <i @click="order = 'asc'" class="fas fa-sort-amount-down mr-2 orderBy-icon"></i> Ascending
                                            </span>
                                        </span>
                                    </label>
                                    <select
                                        class="form-control"
                                        v-model="orderBy"
                                        name="orderBy"
                                        >
                                        <option value= 'id' selected disabled>Sort products</option>
                                      <option value="price">Sort by price</option>
                                      <option value="created_at">Sort by date</option>
                                    </select>
                                </form>
                        </div>
                        <hr>


                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 mt-auto">
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
import ProductItemCard from "../components/shopPageComponents/ProductCard";
import SideBar from "../components/shopPageComponents/Sidebar";
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
