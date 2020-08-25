<template>
        <div class="card card-image-gallery mb-2 mr-2">
                <div class="d-flex flex-column thumbnails">
                    <div v-for="product in products" :key="product.image" class="tb" :class="{tbActive:product.image == selected }" @click="selected = product.image">  <img class="thumbnail-img fit-image" :src='product.image'> </div>
                    <!-- <div id="f2" class="tb"> <img class="thumbnail-img fit-image" src="https://i.imgur.com/3NusNP2.jpg"> </div>
                    <div id="f3" class="tb"> <img class="thumbnail-img fit-image" src="https://i.imgur.com/pXUPOVR.jpg"> </div>
                    <div id="f4" class="tb"> <img class="thumbnail-img fit-image" src="https://i.imgur.com/xX5Qmsa.jpg"> </div> -->
                </div>
                
                    <div v-for="product in products" :key="product.image" class="product-img-field" :class="{active:product.image == selected }" @click="selected = product.image"> <img class="gallery-img" :src='product.image'> </div>
              
        </div>
</template>
<script>
export default {
    data(){
        return{
            products:[
                {image: 'https://i.imgur.com/wL1uRBk.jpg'},
                {image: 'https://i.imgur.com/3NusNP2.jpg'},
                {image: 'https://i.imgur.com/pXUPOVR.jpg'},
                {image: 'https://i.imgur.com/xX5Qmsa.jpg'},
            ],

            selected: ""
        }
    },

    mounted() {
       this.selected = this.products[0].image
    }
}
</script>

<style scoped>
.card-image-gallery {
    margin: auto;
    padding: 20px;
    border:none
}
/* 
fieldset.active {
    display: block 
}

fieldset {
    display: none
} */

.gallery-img {
    width: 400px;
    height: 500px;
    margin-left: 85px;
    margin-right: auto;
    display: block
}

.product-img-field.active {
    padding-left: auto;
    padding-right: auto;
    width: 100%;
    display: block
}
.product-img-field {
    display: none;
}

.thumbnails {
    position: absolute
}

.fit-image {
    width: 100%;
    object-fit: cover
}

.tb {
    width: 62px;
    height: 62px;
    border: 1px solid grey;
    margin: 2px;
    opacity: 0.4;
    cursor: pointer
}

.tbActive {
    opacity: 1
}

.thumbnail-img {
    width: 60px;
    height: 60px
}

@media screen and (max-width: 768px) {
    .pic0 {
        width: 250px;
        height: 350px
    }
}
</style>