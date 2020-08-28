<template>
<div class="sidebar__wrapper" :class="{active: isActive}">
   
   
   <div v-if="isActive" class="closebtn" @click="changeSidebar()"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">
        
        <div class="sidebar-header">
            <h2 class="text-center">Menu</h2>
        </div>

        <ul class="list-unstyled">
            <h3 class="text-center">KATEGÓRIE PRODUKTOV</h3>
            <li>
                <a href="#phoneCovers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main-category">Obaly na mobil</a>
                  <ul class="collapse list-unstyled" id="phoneCovers">
                      <li>
                          <a href="#phoneBrandApple" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle brand-category">Apple</a>
                            <ul class="collapse list-unstyled" id="phoneBrandApple">
                                <li><router-link :to="{name:'obchod-model-obaly', params: {model: 'Iphone 10'}}">Iphone 10</router-link></li>
                                <li><router-link :to="{name:'obchod-model-obaly', params: {model: 'Iphone 9'}}">Iphone 9</router-link></li>
                                <li><router-link :to="{name:'obchod-model-obaly', params: {model: 'Iphone 8'}}">Iphone 8</router-link></li>
                            </ul>
                      </li>
                      <li>
                          <a href="#phoneBrandSamsung" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle brand-category">Samsung</a>
                            <ul class="collapse list-unstyled" id="phoneBrandSamsung">
                              <li @click="sendOption('Galaxy 5')">Galaxy 5</li>
                              <li @click="sendOption('Galaxy 7')">Galaxy 7</li>
                            </ul>
                      </li>
                      <li>
                          <a href="#phoneBrandMotorola" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main-category">Motorola</a>
                            <ul class="collapse list-unstyled" id="phoneBrandMotorola">
                              <li><a href="#">Razr</a></li>
                            </ul>
                      </li>
                  </ul>
            </li>
            <li>
                <a href="#tabletCovers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main-category">Obaly na tablet</a>
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
            <li>
                <a href="#" class="main-category">Ochranné sklá</a>
            </li>
            <li>
                <a href="#" class="main-category">Príslušenstvo</a>
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

    methods:{
        changeSidebar(){
            this.isActive = !this.isActive
        }
    }
}
</script>




