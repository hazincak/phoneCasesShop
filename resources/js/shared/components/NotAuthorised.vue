
<template>
  <div class="text-center error my-center">
    <i class="fas fa-exclamation"></i>
    <h1 class="mt-5">Access denied.</h1>
    <h2>Cannot access admin section. Return to the home page.</h2>
    <router-link :to="{name: 'home'}"><i class="fas fa-home"></i></router-link>
  </div>
</template>

<style scoped>

a{
  color: #888;
}

.error {


  color: #888;
  font-size: 10rem;
}
</style>
