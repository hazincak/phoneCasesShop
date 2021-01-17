<template>
<div class="sidebar__wrapper" :class="{active: isActive}">


   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">

        <div class="p-5">
            <h1 class="text-center">Admin section</h1>
        </div>

        <ul class="list-group ml-5">
           <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'BrandsDashboard'}">Brands & Models</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ColorsAndMaterialsDashboard'}">Colours & Materials</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'CategoriesDashboard'}">Categories</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ProductsDashboard'}">All products</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ManageCarousel'}">Manage carousel</router-link>
            </li>
        </ul>
    </nav>

</div>
</template>
<script>
export default {
    props:{
        isActive: Boolean
    },
}
</script>




