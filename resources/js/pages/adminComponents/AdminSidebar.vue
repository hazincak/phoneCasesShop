<template>
<div class="sidebar__wrapper" :class="{active: isActive}">
   
   
   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">
        
        <div class="sidebar-header">
            <h2 class="text-center">Admin</h2>
        </div>

        <ul class="list-unstyled">
            <div class="sidebar-subheader">
                <h3 class="text-center">Options</h3>
            </div>
            
           <li class="text-left">
                <router-link :to="{name: 'BrandsDashboard'}" class="sidebar--link">Značky & Modely</router-link>
            </li>
            <li class="text-left">
                <router-link :to="{name: 'ColorsAndMaterialsDashboard'}" class="sidebar--link">Farby & Materiály</router-link>
            </li>
            <li class="text-left">
                <router-link :to="{name: 'CategoriesDashboard'}" class="sidebar--link">Kategorie</router-link>
            </li>
            <li class="text-left"> 
                <router-link :to="{name: 'ProductsDashboard'}" class="sidebar--link">Vsetky produkty</router-link>
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




