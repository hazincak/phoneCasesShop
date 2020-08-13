<template>
    <div class="section-shop">
        <div class="container">
            <div v-if="loading">
                Data is loading...
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-md-3 sm-12">
                         <button  @click="sideBarOpen = !sideBarOpen">
                             Toggle
                        </button>
                        <side-bar v-bind:sideBarOpen="sideBarOpen"></side-bar>
                    </div>
                    <div class="col-md-9 sm-12">
                        <bread-crumbs></bread-crumbs>

                        <div class="row mb-4 ">
                            <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>
                             <div class="col-md-4 xs-12"><product-item-card></product-item-card></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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

    // created(){
    //     axios.get()
    // }


   
    
}
</script>