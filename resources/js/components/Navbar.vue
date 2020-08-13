<template>
    <div>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">LOGO</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <router-link :to="{name: 'home'}" class="nav-link" href="#"><i class="fas fa-home"></i> <span class="sr-only">(current)</span></router-link>
            </li>
            <li class="nav-item active" v-if="$route.name == 'shop'">
                <a v-b-toggle.sidebar-1 class="nav-link"><i class="fas fa-bars"></i> Menu</a>
            </li>
        </ul>        
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <router-link :to="{name: 'basket'}" class="nav-link" href="#"><i class="fas fa-shopping-cart"></i><span class="badge badge-pill">4</span></router-link>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Prihlásiť sa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Zaregistrovať sa</a>
        </li>
    </ul>
  </div>
</nav>
    </div>
</template>


