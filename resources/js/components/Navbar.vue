<template>
    <div>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">najlacnejsieobaly.shop</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <router-link :to="{name: 'domov'}" class="nav-link" href="#"><i class="fas fa-home"></i> <span class="sr-only">(current)</span></router-link>
            </li>
        </ul> 
        <ul class= "navbar-nav ml-auto ">
            <li class="nav-item">
                <router-link :to="{name: 'kosik'}" class="nav-link" href="#"><i class="fas fa-shopping-cart"></i><span class="badge badge-secondary badge-pill">{{itemsInBasket}}</span></router-link>
            </li>  
        </ul>     
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="collapse-icon"><i class="fas fa-ellipsis-h"></i></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle login__toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Prihlásiť sa
            </a>
            <login></login>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Zaregistrovať sa</a>
        </li>
    </ul>
  </div>
</nav>
    </div>
</template>
<script>
import Login from "./../pages/authComponents/Login"
import {mapGetters} from "vuex";
export default {
    components:{
        Login
    },
    computed: {
        ...mapGetters({
            itemsInBasket: "itemsInBasket"
        })
    }
}
</script>



