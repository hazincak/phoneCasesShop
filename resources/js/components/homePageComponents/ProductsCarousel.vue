<template>
<div class="carousel-section pb-5">
    <div class="container">
        <div class="separator p-5"><h2>Trending now</h2></div>
       <carousel
        :per-page="4"
        :mouse-drag="false"
        :paginationActiveColor = "'#01a9b4'"
        :paginationColor = "'#777'"

        >
        <slide v-for="(item, index) in carouselProducts" :key="index">
          <div class="card h-100 d-flex flex-column p-2" style="width: 18rem; border-radius: 15px; background-color: #fff; border: 1px solid #87dfd6">
              <router-link :to="{name: 'produkt', params: { id: item.product_id }}">
            <img class="card-img-top" style="border-radius: 15px" :src="item.image.path" alt="Card image cap">
            <div class="card-body pt-5">
                  <h3 class="card-title text-center">{{item.title}}</h3>
                  <h4 class="text-center">Colour: {{item.color}}</h4>
            </div>
              </router-link>
            <div class="mt-auto d-flex justify-content-between border-top">
                <p>{{item.model_name}}</p>
                <p class="text-center"><strong>€{{item.price.toFixed(2)}} <span class="text-muted"></span></strong></p>
            </div>
          </div>
        </slide>
      </carousel>
    </div>
</div>
</template>

<script>
import {Carousel, Slide} from 'vue-carousel';
  export default {

    components:{
      Carousel,
      Slide,
    },

    data() {
      return {
            carouselProducts: {},
            numberOfSlides: Number,

      }
    },
    created(){
        axios.get(`/api/carousel-items`)
        .then(response => {
            this.carouselProducts = response.data;
            console.log(this.carouselProducts);
        })
        .then( () => {
          this.numberOfSlides = this.carouselProducts.length/4
          console.log(this.numberOfSlides);
        })
    },
  }
</script>


