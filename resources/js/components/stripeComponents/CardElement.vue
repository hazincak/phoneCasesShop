<template>
    <div>      
      <card class='stripe-card'
      :class='{ complete }'
      :stripe= "stripeInstance"
      :options='stripeOptions'
      @change='change($event)'
    />
    <div id="card-errors" role="alert" v-text="errorMessage"></div>
    <b-alert class="mt-3" v-if="errors" show variant="danger">{{errors}}</b-alert>
    <hr>
    <!-- <button class='button button--block button--teal button--squared' @click='pay' :disabled='!complete'>Zaplatiť €{{priceToBePaid}} kartou</button> -->
    <button class='button button--block button--teal button--squared' @click='pay'>Zaplatiť €{{priceBreakdown.calculatedTotalPrice.toFixed(2)}} kartou</button>
    </div>
</template>
<script>
    import validationErrors from "../../shared/mixins/validationErrors"
    import { mapState, mapGetters } from "vuex";
    import { Card, createToken } from 'vue-stripe-elements-plus'
    export default {
      props:{
        priceBreakdown: Object,
        customer:Object
    },
        components: { Card },
        mixins: [validationErrors],
        data () {
            return {
            stripeInstance: Stripe('pk_test_51HczEjDDA0O0qOLHNmhiFGzQ87LyksMRmVmKqTpLfRMnvMQrd4XHxltHRT3atQPn1aKwo5TAFuqaxRuOTB7rqhrQ00qVjDabg1', { locale: 'sk' }),
            complete: false,
            errorMessage: '',
            stripeOptions: {
              style:{
                base: {
                  color: '#32325d',
                  lineHeight: '18px',
                  fontFamily: 'inherit',
                  fontSmoothing: 'antialiased',
                  fontSize: '16px',
                  '::placeholder': {
                    color: '#aab7c4'
                  }
                },
                invalid: {
                  color: '#fa755a',
                  iconColor: '##fa755a'
                }
              },
              hidePostalCode: true,
              

        // see https://stripe.com/docs/stripe.js#element-options for details
            }
          }
        },

        computed:{
          ...mapState({
            basket:state => state.basket.items
           })
    },
        methods: {
            pay() {
             
             
              // createToken returns a Promise which resolves in a result object with
              // either a token or an error key.
              // See https://stripe.com/docs/api#tokens for the token object.
              // See https://stripe.com/docs/api#errors for the error object.
              // More general https://stripe.com/docs/stripe.js#stripe-create-token.

              createToken().then(data => this.paymentRequest(data.token))
              
              
     
            },

            async paymentRequest(data){
              this.errors = null;
              this.setTotalPriceBreakdown(null);
              
              try {
                const response = await axios.post(`/api/stripe-checkout`, {customer: this.customer, price: this.priceBreakdown, data: data, basket: this.basket},)   
                console.log(response.data.status)
                console.log(response.data.msg)
                if(response.data.status === 'success'){
                 this.setTotalPriceBreakdown(this.priceBreakdown);
                 this.$router.push({ name: "successfulCheckout" });
                }
              } catch (error) {
                this.errors = error.response && error.response.data.errors
              }
             
            }, 
            change(event){
              this.errorMessage = event.error ? event.error.message : ''
            },
            setTotalPriceBreakdown(payload){
              this.$store.dispatch('setTotalPriceBreakdown', payload);
            }
        }
    }
</script>
<style>


.stripe-card {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid #ccd0d2;
  border-radius: 4px;
  background-color: white;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.stripe-card--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

#card-errors{
  color: #fa755a;
  font-size: 14px;
}

.stripe-card--invalid {
  border-color: #fa755a;
}

.stripe-card--webkit-autofill {
  background-color: #fefde5 !important;
}


</style> 