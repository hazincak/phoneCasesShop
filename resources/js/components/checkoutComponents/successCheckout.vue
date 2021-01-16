<template>
  <div class="container-fluid">

      <div class="jumbotron jumbotron-fluid text-center" style="background-color: transparent !important">
          <h1 class="display-3 text-teal"><i class="far fa-thumbs-up"></i> Thank you for your order!</h1>
          <p><strong>Please check your email.</strong></p>
          <p>Due to the high volume of orders, we're sending out individual items as soon as we can so you can get them quicker. All of your order will still arrive on or before your expected delivery date.</p>
          <hr>
          <p>
            <router-link class="text-teal" :to="{name: 'domov'}">Return to home page</router-link>
          </p>
      </div>
    <div class="row justify-content-center mb-5">
      <div class="col-md-6">
        <div class="d-flex mt-3 justify-content between">
        <h3 class="underlined-header text-uppercase font-weight-bolder">Order details</h3>
      </div>
        <table class="table mt-3 ">
            <thead>
              <tr style="border-top: hidden">
                <th scope="col">#</th>
                <th scope="col">Product description</th>
                <th scope="col">Price</th>
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
        <h4>Products total</h4>
        <p>€{{productsPrice.toFixed(2)}}</p>
    </div>
    <div class="d-flex border-top p-4 justify-content-between">
        <h4>Delivery</h4>
        <p v-if="priceBreakdown.paidDelivery">€{{priceBreakdown.deliveryFee}}</p>
        <p v-else>FREE</p>
    </div>
    <div v-if="priceBreakdown.paymentFee !== 0" class="d-flex border-top p-4 justify-content-between">
        <h4>Payment method fee</h4>
        <p>€{{priceBreakdown.paymentFee}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h3>Total</h3>
        <h3>€{{priceBreakdown.calculatedTotalPrice.toFixed(2)}}</h3>
    </div>

    <div class="d-flex mt-3 justify-content between">
        <h3 class="text-uppercase text-teal font-weight-bolder">Delivery and payment methods</h3>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Delivery method</h4>
        <p>{{priceBreakdown.deliveryMethod}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Payment method</h4>
        <p>{{priceBreakdown.paymentMethod}}</p>
    </div>

    <div class="d-flex mt-3 justify-content between">
        <h3 class="text-uppercase text-teal font-weight-bolder">Recipient details</h3>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Name & Surname</h4>
        <p>{{customer.first_name + ' ' + customer.last_name }}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Email</h4>
        <p>{{customer.email}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Phone number</h4>
        <p>{{customer.phone_number}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Street name and street number</h4>
        <p>{{customer.street_name + ' ' + customer.street_number}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>City</h4>
        <p>{{customer.city}}</p>
    </div>
    <div class="d-flex p-4 border-top justify-content-between">
        <h4>Eircode</h4>
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
