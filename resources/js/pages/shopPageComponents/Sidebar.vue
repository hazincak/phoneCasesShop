<template>
<div class="wrapper">
   
    <nav id="sidebar" class="active">
        <div class="sidebar-header">
            <h3>Menu</h3>
        </div>

        <ul class="list-unstyled components">
            <h5>KATEGÓRIE PRODUKTOV</h5>
            <li>
                <a href="#phoneCovers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Obaly na mobil</a>
                  <ul class="collapse list-unstyled" id="phoneCovers">
                      <li>
                          <a href="#phoneBrandApple" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Apple</a>
                            <ul class="collapse list-unstyled" id="phoneBrandApple">
                                <li @click="sendOption('/obaly-na-Iphone 10')">Iphone 10</li>
                                <li @click="sendOption('-podla-modelu/Iphone 9')">Iphone 9</li>
                            </ul>
                      </li>
                      <li>
                          <a href="#phoneBrandSamsung" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Samsung</a>
                            <ul class="collapse list-unstyled" id="phoneBrandSamsung">
                              <li @click="sendOption('Galaxy 5')">Galaxy 5</li>
                              <li @click="sendOption('Galaxy 7')">Galaxy 7</li>
                            </ul>
                      </li>
                      <li>
                          <a href="#phoneBrandMotorola" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Motorola</a>
                            <ul class="collapse list-unstyled" id="phoneBrandMotorola">
                              <li><a href="#">Razr</a></li>
                            </ul>
                      </li>
                  </ul>
            </li>
            <li>
                <a href="#tabletCovers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Obaly na tablet</a>
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
                <a href="#">Ochranné sklá</a>
            </li>
            <li>
                <a href="#">Príslušenstvo</a>
            </li>
        </ul>
    </nav>

</div>
</template>

<script>
export default {
  methods: {
    sendOption(arg){
      this.$emit('menu-option', arg);
    }
  }
}
</script>


