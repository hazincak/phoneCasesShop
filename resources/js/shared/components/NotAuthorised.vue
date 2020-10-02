
<template>
  <div class="text-center error my-center">
    <i class="fas fa-exclamation"></i>
    <h1 class="mt-5">Prístup zamietnutý.</h1>
    <h2>Prístup zamietnutý, pokračujte prosím na úvodnú stránku.</h2>
    <router-link :to="{name: 'domov'}"><i class="fas fa-home"></i></router-link>
  </div>
</template>

<style scoped>
.error {
  color: #999;
  font-size: 10rem;
}
</style>