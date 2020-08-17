<template>
    <div class="container">
            <div v-if="loading">
                Data is loading...
            </div>
            <div v-else>
                <bread-crumbs></bread-crumbs>
                <div class="row">
                    <div class="col-md-3 sm-12">
                         <button  @click="sideBarOpen = !sideBarOpen">
                             Toggle
                        </button>
                        <side-bar v-bind:sideBarOpen="sideBarOpen"></side-bar>
                    </div>
                    <div class="col-md-9 sm-12">
                        
                        <div class="row mb-4">
                            <div v-for="product in products" :key="product.id" class="col-md-4 xs-12"><product-item-card v-bind:product="product"></product-item-card></div>
                        </div>
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

    props:{
        sideBarOpen:Boolean
    },

    components:{
        ProductItemCard, SideBar
    },

    data(){
        return{
            products:null,
            loading:false
        }
    },

    created(){
        this.loading = true

        const request = axios.get("api/obchod/produkty")
        .then(response => {
        this.products = response.data
        this.loading = false;
        });
    },
}
</script>