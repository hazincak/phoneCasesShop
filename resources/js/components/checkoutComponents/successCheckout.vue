<template>
  <div class="container-fluid">
  
      <div class="jumbotron jumbotron-fluid text-center" style="background-color: transparent !important">
          <h1 class="display-3 text-teal"><i class="far fa-thumbs-up"></i> Ďakujeme za vašu objednávku!</h1>
          <p><strong>Prosím skontrolujte svoj email.</strong></p>
          <p>Sme radi, že ste sa rozhodli pre nákup v našom e-shope.</p>
          <p>Vašu objednávku sa budeme snažiť čo najskôr vybaviť, o procese vybavovania budete pravidelne informovaná/-ý.</p>
          <hr>
          <p>
            <router-link class="text-teal" :to="{name: 'domov'}">Návrat na domovskú stránku</router-link>
          </p>
      </div>
    <div class="row justify-content-center mb-5">
      <div class="col-md-6">
        <div class="d-flex mt-3 justify-content between">    
        <h3 class="underlined-header text-uppercase font-weight-bolder">Zhrnutie objednávky</h3>
      </div>
        <table class="table mt-3 ">
            <thead>
              <tr style="border-top: hidden">
                <th scope="col">#</th>
                <th scope="col">Popis produktu</th>
                <th scope="col">Cena</th>
              </tr>
            </thead>
              <tbody v-for="(item, index) in basket" :key="index">
                  <tr>
                      <td>{{index+1}}</td>
                      <td>{{item.product.title}}</td>
                      <td class="float-right">€{{item.product.price}}</td>
                  </tr>
              </tbody>
        </table>
      <hr>
    <div class="d-flex mt-5 justify-content between">    
        <h3 class="text-uppercase text-teal font-weight-bolder">výpočet ceny</h3>
    </div>
    <div class="d-flex border-top p-4 justify-content-between">
        <h4>Produkty spolu</h4> 
        <p>€{{productsPrice.toFixed(2)}}</p> 
    </div>
    <div class="d-flex border-top p-4 justify-content-between">
        <h4>Doprava</h4> 
        <p v-if="priceBreakdown.paidDelivery">€{{priceBreakdown.deliveryFee}}</p>
        <p v-else>ZADARMO</p> 
    </div>
    <div v-if="priceBreakdown.paymentFee !== 0" class="d-flex border-top p-4 justify-content-between">
        <h4>Platba dobierkou</h4> 
        <p>€{{priceBreakdown.paymentFee}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h3>Cena spolu</h3> 
        <h3>€{{priceBreakdown.calculatedTotalPrice.toFixed(2)}}</h3>
    </div>

    <div class="d-flex mt-3 justify-content between">    
        <h3 class="text-uppercase text-teal font-weight-bolder">Spôsob dopravy a platby</h3>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Spôsob dopravy</h4> 
        <p>{{priceBreakdown.deliveryMethod}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Spôsob platby</h4> 
        <p>{{priceBreakdown.paymentMethod}}</p>
    </div>

    <div class="d-flex mt-3 justify-content between">    
        <h3 class="text-uppercase text-teal font-weight-bolder">Kontaktné údaje a adresa príjemcu</h3>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Meno a priezvisko</h4> 
        <p>{{customer.first_name + ' ' + customer.last_name }}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Email</h4> 
        <p>{{customer.email}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Telefónne číslo</h4> 
        <p>{{customer.phone_number}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Názov a číslo ulice</h4> 
        <p>{{customer.street_name + ' ' + customer.street_number}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Mesto</h4> 
        <p>{{customer.city}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Poštové smerovacie číslo</h4> 
        <p>{{customer.zip}}</p>
    </div>

      </div>
      <!-- column -->
      </div>
      <!-- row               -->

  </div>
  <!-- container -->
</template>
<script>
import {mapState, mapGetters} from 'vuex';
export default {
  data(){
    return{
      counter: 0
    }
  },

  computed:{
    ...mapGetters(['productsPrice', 'customer']),
    ...mapState({
        basket:state => state.basket.items,
        priceBreakdown: state => state.totalPriceBreakdown,
        customer: state => state.customer, 
        })
    },
}
</script>
