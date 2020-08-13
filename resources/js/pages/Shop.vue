<template>
    <div class="section-shop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <side-bar></side-bar>
                </div>
                <div class="col-md-10">
                    <bread-crumbs></bread-crumbs>
                    <button  @click="this.isOpen = false"  class="btn btn-info">
                <i class="fas fa-align-left"></i>
                <span>Toggle Sidebar</span>
            </button>
                    <div class="row mb-4 ">
                    
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>

                    </div>
                    <div class="row mb-4 ">
                    
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>

                    </div>
                    <div class="row mb-4 ">
                    
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>
                        <div class="col d-flex align-items-stretch"><product-item-card></product-item-card></div>

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

    components:{
        ProductItemCard, SideBar
    },

   

    data(){
        return{
            isOpen: true
        }
       
    },

    
}
</script>