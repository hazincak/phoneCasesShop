<template>
    <div>
        <home-title></home-title>
        <home-cards></home-cards>

        <products-carousel></products-carousel>

    </div>
</template>

<script>
import HomeTitle from "../components/homePageComponents/Title";
import ProductsCarousel from "../components/homePageComponents/ProductsCarousel";
import HomeCards from "../components/homePageComponents/HomeCards";



export default {
    components:{
        HomeTitle, HomeCards, ProductsCarousel
    }
}
</script>
