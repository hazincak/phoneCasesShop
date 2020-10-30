<template>
    <div ref='paypal'></div>
</template>
<script>

import { mapState, mapGetters } from "vuex";
export default {
    props:{
        priceBreakdown: Object,
        customer:Object
    },

    mounted: function() {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=ARW5P-eRi2sHOC2zpRo554FbOiZyUcFBPlMv8iJlWlrKCt43N21KijjGoi4jbCi2DVZItvsJ72VbHgEv&currency=EUR&disable-funding=credit,card";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },

  computed:{
          ...mapState({
            basket:state => state.basket.items
           })
    },

  methods:{
      setLoaded: function(resp) {
        this.setTotalPriceBreakdown(null);
        this.setCustomer(null);
      
      //add Loading
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: 'Test Description',
                  amount: {
                    currency_code: "EUR",
                    value: this.priceBreakdown.calculatedTotalPrice.toFixed(2),
                  }
                }
              ]
            });
          },
          onApprove: async (data, actions, resp) => {
            const order = await actions.order.capture();
            console.log(order);
            this.modelCustomer(order);
            this.setTotalPriceBreakdown(this.priceBreakdown);
            this.setCustomer(this.customer);
            this.$router.push({ name: "successfulCheckout" });
          },
          onError: err => {
            console.log(err);
          }
        })
        .render(this.$refs.paypal);
    },

    modelCustomer(payPalResponse){
        this.customer.first_name = payPalResponse.payer.name.given_name;
        this.customer.last_name = payPalResponse.payer.name.surname;
        this.customer.email = payPalResponse.payer.email_address;
        this.customer.city = payPalResponse.purchase_units[0].shipping.address.admin_area_2;
        this.customer.street_name = payPalResponse.purchase_units[0].shipping.address.address_line_1;
        this.customer.street_number = payPalResponse.purchase_units[0].shipping.address.address_line_2;
        this.customer.zip = payPalResponse.purchase_units[0].shipping.address.postal_code;
    },

    setTotalPriceBreakdown(payload){
        this.$store.dispatch('setTotalPriceBreakdown', payload);
    },
    setCustomer(payload){
        this.$store.dispatch('setCustomer', payload);
    },


   
  }



}
</script>