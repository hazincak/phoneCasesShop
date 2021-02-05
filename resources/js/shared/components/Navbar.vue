<template>
    <div>
    <nav class="navbar fixed-top navbar-expand-md navbar-dark ">
        <img class="navbar-brand" src="../../../images/logos/logo.svg">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <router-link :to="{name: 'home'}" class="nav-link" href="#"><i class="fas fa-home"></i> <span class="sr-only">(current)</span></router-link>
            </li>
        </ul>
        <ul class= "navbar-nav ml-auto ">
            <li class="nav-item">
                <router-link :to="{name: 'cart'}"   class="nav-link" ><i class="fas fa-shopping-cart"></i><span class="badge badge-secondary badge-pill">{{itemsInBasket}}</span></router-link>
            </li>
        </ul>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="collapse-icon"><i class="fas fa-ellipsis-h"></i></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">


        <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'shop'}">Shop</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'rules-of-returns'}">Return & Refund</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'trading-terms'}">Trading Terms</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'gdpr'}">GDPR</router-link>
        </li>
        <li  v-if="!isLoggedIn" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle login__toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
            </a>
            <login></login>
        </li>
        <li v-else class="nav-item dropdown">
            <a class="nav-link dropdown-toggle login__toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{this.$store.state.user.email}}
            </a>
            <login></login>
        </li>
    </ul>
  </div>
</nav>
    </div>
</template>
<script>
import Login from "../../components/authComponents/Login";
import {mapState ,mapGetters} from "vuex";
export default {
    components:{
        Login
    },
    computed: {
        ...mapState({
           isLoggedIn: "isLoggedIn"
        }),

        ...mapGetters({
            itemsInBasket: "itemsInBasket"
        })
    }
}
</script>
<style scoped>
    .logo{
        width: 2rem;
    }
</style>



