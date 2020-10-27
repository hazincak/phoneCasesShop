<template>
    <div>
        <home-title></home-title>
        <home-cards></home-cards>
    </div>
</template>

<script>
import HomeTitle from "../components/homePageComponents/Title";
import HomeCards from "../components/homePageComponents/HomeCards";



export default {
    components:{
        HomeTitle, HomeCards
    }
}
</script>