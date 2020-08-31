<template>
<div class="sidebar__wrapper" :class="{active: isActive}">
   
   
   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">
        
        <div class="sidebar-header">
            <h2 class="text-center">Menu</h2>
        </div>

        <ul class="list-unstyled">
            <div class="sidebar-subheader">
                <h3 class="text-center">Kategorie produktov</h3>
            </div>
            
            <li class="text-center">
                <a href="#phoneCovers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar__itemMainCategory">Obaly na mobil</a>
                  <ul class="collapse list-unstyled" id="phoneCovers">
                      <li>
                          <a href="#phoneBrandApple" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar__itemBrandCategory">Apple</a>
                            <ul class="collapse list-unstyled" id="phoneBrandApple">
                                <li><router-link class="sidebar__itemModelCategory" :to="{name:'obchod-model-obaly', params: {model: 'Iphone 10'}}">Iphone 10</router-link></li>
                                <li><router-link class="sidebar__itemModelCategory"  :to="{name:'obchod-model-obaly', params: {model: 'Iphone 9'}}">Iphone 9</router-link></li>
                                <li><router-link class="sidebar__itemModelCategory"  :to="{name:'obchod-model-obaly', params: {model: 'Iphone 8'}}">Iphone 8</router-link></li>
                            </ul>
                      </li>
                      <li>
                          <a href="#phoneBrandMotorola" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar__itemBrandCategory">Motorola</a>
                            <ul class="collapse list-unstyled" id="phoneBrandMotorola">
                              <li><router-link class="sidebar__itemModelCategory" :to="{name:'obchod-model-obaly', params: {model: 'Iphone 10'}}">Iphone 10</router-link></li>
                            </ul>
                      </li>
                  </ul>
            </li>
            <li class="text-center">
                <a href="#tabletCovers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar__itemMainCategory">Obaly na tablet</a>
                <ul class="collapse list-unstyled" id="tabletCovers">
                    <li>
                          <a href="#tabletBrandApple" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Apple</a>
                            <ul class="collapse list-unstyled" id="tabletBrandApple">
                                <li><a href="#">Apple iPad Pro</a></li>
                            </ul>
                      </li>
                      <li>
                          <a href="#tabletBrandSamsung" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Samsung</a>
                            <ul class="collapse list-unstyled" id="tabletBrandSamsung">
                              <li><a href="#">Galaxy Tab s</a></li>
                            </ul>
                      </li>
                </ul>
            </li>
            <li class="text-center">
                <a href="#" class="sidebar__itemMainCategory">Ochranné sklá</a>
            </li>
            <li class="text-center">
                <a href="#" class="sidebar__itemMainCategory">Príslušenstvo</a>
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




