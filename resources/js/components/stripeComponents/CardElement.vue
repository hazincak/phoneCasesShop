<template>
    <div>
      <card class='stripe-card'
      :class='{ complete }'
      :stripe= "stripeInstance"
      :options='stripeOptions'
      @change='change($event)'
    />
    <div id="card-errors" role="alert" v-text="errorMessage"></div>
    <hr>
    <!-- <button class='button button--block button--teal button--squared' @click='pay' :disabled='!complete'>Zaplatiť €{{priceToBePaid}} kartou</button> -->
    <button class='button button--block button--teal button--squared' @click='pay'>Zaplatiť €{{priceToBePaid}} kartou</button>
    </div>
</template>
<script>
    
    import { Card, createToken } from 'vue-stripe-elements-plus'
    export default {
      props:{
        priceToBePaid: String,
        customer:Object
    },
        components: { Card },
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
        methods: {
            pay() {
             
             
              // createToken returns a Promise which resolves in a result object with
              // either a token or an error key.
              // See https://stripe.com/docs/api#tokens for the token object.
              // See https://stripe.com/docs/api#errors for the error object.
              // More general https://stripe.com/docs/stripe.js#stripe-create-token.

              createToken().then(data => this.paymentRequest(data.token))
              
              
     
            },

            paymentRequest(data){


              const response = axios.post(`/api/stripe-checkout`, {customer: this.customer, price: this.priceToBePaid, data: data},)
            }, 


            change(event){
              this.errorMessage = event.error ? event.error.message : ''
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