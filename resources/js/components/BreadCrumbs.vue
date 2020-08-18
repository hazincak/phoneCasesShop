<template>
    <div >
        <!-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav> -->
        <!-- <router-link :to="{name: 'domov'}">Domov</router-link>
        <router-link :to="{name: 'obchod'}">Obchod</router-link>
        <router-link :to="{name: 'produkt'}">Produkt</router-link>
        <router-link :to="{name: 'kosik'}">Kosik</router-link> -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
          <li v-for="(breadcrumb,index) in breadcrumbList" :key = "index" @click="routeTo(index)" class="breadcrumb-item" :class="{'active': !breadcrumb.link}">
            {{breadcrumb.name}}
          </li>
          </ol>
        </nav>
    </div>
</template>
<script>
export default {
  name: 'Breadcrumb',
  

  data(){
    return {
      breadcrumbList: []
    }
  },

  mounted(){this.updateList()},
  watch: {'$route' () {this.updateList()}},
  methods: {
    routeTo(pRouteTo){
      if(this.breadcrumbList[pRouteTo].link) this.$router.push(this.breadcrumbList[pRouteTo].link)
    },
    updateList(){this.breadcrumbList = this.$route.meta.breadcrumb}
  }
}
</script>

<style scoped>
 a {
   margin: 0 10px;
 } 
</style>