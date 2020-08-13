<template>
    <div class="section-shop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <sidebar></sidebar>
                </div>
                <div class="col-md-10">
                    <bread-crumbs></bread-crumbs>
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
export default {
    components:{
        ProductItemCard
    }
}
</script>