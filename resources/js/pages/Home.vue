<template>
    <div>
        <home-title></home-title>
        <home-cards></home-cards>
    </div>
</template>

<script>
import HomeTitle from "./homePageComponents/Title";
import HomeCards from "./homePageComponents/HomeCards";



export default {
    components:{
        HomeTitle, HomeCards
    }
}
</script>