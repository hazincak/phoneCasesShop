<template>
        <div class="card card-image-gallery mb-2 mr-2">
                <div class="d-flex flex-column thumbnails">
                    <div v-for="image in product.images" :key="product.images[image]"  class="tb" :class="{tbActive:image.path == selected }" @click="selected = image.path">  <img class="thumbnail-img fit-image" :src='image.path'> </div>
                    <!-- <div id="f2" class="tb"> <img class="thumbnail-img fit-image" src="https://i.imgur.com/3NusNP2.jpg"> </div>
                    <div id="f3" class="tb"> <img class="thumbnail-img fit-image" src="https://i.imgur.com/pXUPOVR.jpg"> </div>
                    <div id="f4" class="tb"> <img class="thumbnail-img fit-image" src="https://i.imgur.com/xX5Qmsa.jpg"> </div> -->
                </div>
                
                    <div v-for="image in product.images" :key="product.images[image]" class="product-img-field" :class="{active:image.path == selected }" @click="selected = image.path"> <img class="gallery-img" :src='image.path'> </div>
              
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