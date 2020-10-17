<template>
    <div>
        <card class='stripe-card'
      :class='{ complete }'
      stripe='pk_test_XXXXXXXXXXXXXXXXXXXXXXXX'
      :options='stripeOptions'
      @change='complete = $event.complete'
    />
    <div id="card-errors" role="alert"></div>
    </div>
</template>
<script>
    import { Card, createToken } from 'vue-stripe-elements-plus'
    export default {
        components: { Card },
        data () {
            return {
            complete: false,
            stripeOptions: {
        // see https://stripe.com/docs/stripe.js#element-options for details
            }
          }
        },
        methods: {
            pay () {
              // createToken returns a Promise which resolves in a result object with
              // either a token or an error key.
              // See https://stripe.com/docs/api#tokens for the token object.
              // See https://stripe.com/docs/api#errors for the error object.
              // More general https://stripe.com/docs/stripe.js#stripe-create-token.
              // createToken().then(data => console.log(data.token))
              alert(paying);
            }
        }
    }
</script>
<style>
.stripe-card {
  box-sizing: border-box;
  font-family: inherit;

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

.stripe-card--invalid {
  border-color: #fa755a;
}

.stripe-card--webkit-autofill {
  background-color: #fefde5 !important;
}
/* .stripe-card {
  width: 300px;
  border: 1px solid grey;
}
.stripe-card.complete {
  border-color: green;
} */

</style> 