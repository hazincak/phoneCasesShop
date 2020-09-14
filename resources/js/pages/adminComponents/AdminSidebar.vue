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
                <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar__itemMainCategory">Produkty</a>
                  <ul class="collapse list-unstyled" id="products">
                      <li class="text-center">
                        <router-link :to="{name: 'allProducts'}" class="sidebar__itemMainCategory">Vsetky produkty</router-link>
                      </li>
                       <li class="text-center">
                            <router-link :to="{name: 'addProduct'}" class="sidebar__itemMainCategory">Pridať produkt</router-link>
                       </li>
                  </ul>
            </li>


           
            <li class="text-left">
                <router-link :to="{name: 'users'}" class="sidebar__itemMainCategory">Užívatelia</router-link>
            </li>
            <li class="text-left">
                <router-link :to="{name: 'CategoriesDashboard'}" class="sidebar__itemMainCategory">Kategorie</router-link>
            </li>
            <li class="text-left">
                <router-link :to="{name: 'BrandsDashboard'}" class="sidebar__itemMainCategory">Značky</router-link>
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




