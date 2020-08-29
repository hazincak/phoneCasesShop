<template>
        <div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div v-for="image in product.images" :key="product.images[image]" class=" product-img-field" :class="{active:image.path == selected }" @click="selected = image.path"> <img class="gallery-img img-fluid" :src='image.path'> </div>
                </div>
                
            </div>
            <div class="row justify-content-center ">
                
                    <div v-for="image in product.images" :key="product.images[image]"  class="tb" :class="{tbActive:image.path == selected }" @click="selected = image.path">  <img class="thumbnail-img fit-image img-fluid" :src='image.path'> </div>
                
            </div>      
        </div>
</template>
<script>
export default {

    props:{
        "product": Object
    },

    data(){
        return{
            selected: ""
        }
    },

    mounted() {
       this.selected = this.product.images[0].path
    }
}
</script>

