<template>
<div class="sidebar__wrapper" :class="{active: isActive}">
   
   
   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">
        
        <div class="p-5">
            <h1 class="text-center">Admin</h1>
        </div>

        <ul class="list-group">
           <li class="text-left mb-4 mt-4">
                <router-link :to="{name: 'BrandsDashboard'}" class="sidebar--link-main">Značky & Modely</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link :to="{name: 'ColorsAndMaterialsDashboard'}" class="sidebar--link-main">Farby & Materiály</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link :to="{name: 'CategoriesDashboard'}" class="sidebar--link-main">Kategórie</router-link>
            </li>
            <li class="text-left mb-4 mt-4"> 
                <router-link :to="{name: 'ProductsDashboard'}" class="sidebar--link-main">Všetky produkty</router-link>
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




