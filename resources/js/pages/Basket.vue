<template>
    <div class="container">
        <b-breadcrumb>
            <router-link class="breadcrumb-link" :to="{name: 'domov'}"> <i class="fas fa-home"></i> Home/</router-link>
            <router-link class="breadcrumb-link" :to="{name: 'obchod'}">Shop/</router-link>
            <b-breadcrumb-item active>Shopping cart</b-breadcrumb-item>
        </b-breadcrumb>
        <div class="row mt-5" v-if="itemsInBasket">
            <div class="col-md-5 order-md-2">
                <div class="d-flex justify-content-between">
                    <h3 class="text-uppercase  font-weight-bolder">Shopping cart</h3>
                    <h3 class="badge badge-secondary text-uppercase">
                        <span>Počet: {{itemsInBasket}}</span>
                    </h3>
                </div>
                <div>
                    <transition-group name="fade">
                    <div v-for="item in basket" :key="item.product.id" class="basket pt-2 pb-2 border-top d-flex justify-content-between">
                           <div class="p-2 "><img class="img-fluid basket__img" :src='item.product.main_image.path' alt=""></div>
                           <div class="d-flex align-items-center">
                               <router-link :to="{name: 'produkt', params: {id: item.product.id}}">{{item.product.title}}</router-link>
                           </div>

                        <!-- <div class="pt-2 pb-2 text-right"> -->
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold ml-2 mr-2">€{{item.product.price}}</span>
                        </div>
                        <div class="d-flex align-items-center">
                                <button class="btn btn-lg btn-outline-secondary" @click="$store.dispatch('removeFromBasket', item.product.id)">
                                <i class="fas fa-trash-alt basket__icon"></i>
                                </button>
                        </div>
                    </div>
                    </transition-group>
                    <div class="d-flex mt-2 justify-content between">
                        <h3 class="text-uppercase  font-weight-bolder">Price calculation</h3>
                    </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Subtotal</h4>
                            <h4>€{{productsPrice.toFixed(2)}}</h4>
                        </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Transport</h4>
                            <h4>

                                <div v-if="priceBreakdown.paidDelivery">
                                     €{{priceBreakdown.deliveryFee}}
                                </div>
                                <div v-else>
                                    FREE
                                </div>
                            </h4>
                        </div>
                        <div v-if="priceBreakdown.paymentMethod === 'Platba dobierkou'">
                            <div class="d-flex border-top p-2 justify-content-between">
                                <h4 class="text-secondary">Payment method</h4>
                                <h4>
                                    €{{priceBreakdown.paymentFee}}
                                </h4>
                            </div>
                        </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Total price</h4>
                            <h4>
                                    €{{priceBreakdown.calculatedTotalPrice.toFixed(2)}}
                            </h4>
                        </div>

                </div>
            </div>
            <div class="col-md-7">
                <div v-if="priceBreakdown.paymentMethod === 'PayPal'">
                    <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="alert alert-secondary" role="alert">
                            If paying with PayPal, we will use your personal detail linked to your PayPal account.
                            Please enter your phone number to complete this order.
                        </div>
                        <label for="phoneNumber">Phone number</label>
                        <input
                         class="form-control"
                         name="phoneNumber"
                         v-model="customer.phone_number"
                         >
                    </div>
                </div>
                </div>
                <div v-if="priceBreakdown.paymentMethod !== 'PayPal'">
                <div class="row">
                    <div class="col-md-6  form-group">
                        <label for="first_name">Name</label>
                        <input
                        type="text"
                        class="form-control"
                        name="first_name"
                        v-model="customer.first_name"
                        :class="[{'is-invalid': errorFor('customer.first_name')}]"
                       >
                       <v-errors :errors="errorFor('customer.first_name')"></v-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Surname</label>
                        <input
                        type="text"
                        class="form-control"
                        name="last_name"
                        v-model="customer.last_name"
                        :class="[{'is-invalid': errorFor('customer.last_name')}]"
                        >
                        <v-errors :errors="errorFor('customer.last_name')"></v-errors>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="phoneNumber">Phone number</label>
                        <input
                         class="form-control"
                         name="phoneNumber"
                         v-model="customer.phone_number"
                         :class="[{'is-invalid': errorFor('customer.phone_number')}]"
                         >
                         <v-errors :errors="errorFor('customer.phone_number')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="email">Email</label>
                        <input
                        type="email"
                         class="form-control"
                         name="email"
                         v-model="customer.email"
                         :class="[{'is-invalid': errorFor('customer.email')}]"
                         >
                         <v-errors :errors="errorFor('customer.email')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="street_name">Street name</label>
                        <input
                        type="text"
                        class="form-control"
                        name="street_name"
                        v-model="customer.street_name"
                        :class="[{'is-invalid': errorFor('customer.street_name')}]"
                        >
                        <v-errors :errors="errorFor('customer.street_name')"></v-errors>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="street_number">Street number</label>
                        <input
                        type="text"
                        class="form-control"
                        name="street_number"
                        v-model="customer.street_number"
                        :class="[{'is-invalid': errorFor('customer.street_number')}]"
                        >
                        <v-errors :errors="errorFor('customer.street_number')"></v-errors>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="city">City</label>
                        <input
                        type="text"
                        class="form-control"
                        name="city"
                        v-model="customer.city"
                        :class="[{'is-invalid': errorFor('customer.city')}]"
                        >
                        <v-errors :errors="errorFor('customer.city')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 form-group">
                  <div class="input-group-prepend">
                    <label for="county">County</label>
                  </div>
                  <select
                    class="custom-select"
                    id="inputGroupSelect01"
                    v-model="customer.county"
                    :class="[{'is-invalid': errorFor('customer.county')}]"
                    >
                    <option selected>Select your county</option>
                    <option>Antrim</option>
                    <option > Armagh</option>
                    <option> Carlow</option>
                    <option> Cavan</option>
                    <option> Clare</option>
                    <option> Cork</option>
                    <option> Donegal</option>
                    <option> Down</option>
                    <option> Dublin</option>
                    <option> Fermanagh</option>
                    <option> Galway</option>
                    <option> Kerry</option>
                    <option> Kildare</option>
                    <option> Kilkenny</option>
                    <option> Laois</option>
                    <option> Leitrim</option>
                    <option> Limerick</option>
                    <option> Londonderry</option>
                    <option> Longford</option>
                    <option> Louth</option>
                    <option> Mayo</option>
                    <option> Meath</option>
                    <option> Monaghan</option>
                    <option> Offaly</option>
                    <option> Roscommon</option>
                    <option> Sligo</option>
                    <option> Tipperary</option>
                    <option> Tyrone</option>
                    <option> Waterford</option>
                    <option> Westmeath</option>
                    <option> Wexford</option>
                    <option> Wicklow</option>
                  </select>
                </div>
                    <div class="col-md-4 form-group">
                        <label for="zip">Eircode</label>
                        <input
                        type="text"
                        class="form-control"
                        name="zip"
                        v-model="customer.zip"
                        :class="[{'is-invalid': errorFor('customer.zip')}]"
                        >
                        <v-errors :errors="errorFor('customer.zip')"></v-errors>
                    </div>
                </div>
            </div>
                <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                        <h3>Payment <i class="far fa-money-bill-alt"></i></h3>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment1" v-model='priceBreakdown.paymentMethod' value="Money transfer" >
                          <label class="form-check-label" for="payment1">
                            Money transfer
                            <transition name="fade">
                                <span v-if="priceBreakdown.paymentMethod === 'Money transfer'" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment2"  v-model='priceBreakdown.paymentMethod' value="PayPal">
                          <label class="form-check-label" for="payment2">
                            PayPal
                            <transition name="fade">
                                <span v-if="priceBreakdown.paymentMethod === 'PayPal'" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment3" v-model='priceBreakdown.paymentMethod' value="Online payment (Stripe)">
                          <label class="form-check-label" for="payment3">
                            Online payment (Stripe)
                            <transition name="fade">
                                <span v-if="priceBreakdown.paymentMethod === 'Online payment (Stripe)'" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment4" v-model='priceBreakdown.paymentMethod' value="Platba dobierkou">
                          <label class="form-check-label" for="payment4">
                            Platba dobierkou (pri preberaní tovaru)
                            <transition name="fade">
                                <span v-if="priceBreakdown.paymentMethod === 'Platba dobierkou'" class="badge badge-secondary">€1,59</span>
                            </transition>
                          </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h3>Delivery method <i class="fas fa-shuttle-van"></i></h3>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliverymethod" id="deliveryMethod1" v-model='priceBreakdown.deliveryMethod' value="An Post" :disabled = '!priceBreakdown.paidDelivery'>
                          <label class="form-check-label" for="deliveryMethod1">
                            An Post
                            <transition name="fade">
                                <span v-if="priceBreakdown.deliveryMethod === 'An Post'" class="badge badge-secondary">€1,79</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethod2" v-model='priceBreakdown.deliveryMethod' value="DHL Express" :disabled = '!priceBreakdown.paidDelivery'>
                          <label class="form-check-label" for="deliveryMethod2">
                            DHL Express
                            <transition name="fade">
                                <span v-if="priceBreakdown.deliveryMethod === 'DHL Express'" class="badge badge-secondary">€1,99</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethod3" v-model='priceBreakdown.deliveryFee' :value=0 :disabled = 'priceBreakdown.paidDelivery'>
                          <label class="form-check-label" for="deliveryMethod3">
                            Order over €29.99 - FREE delivery
                            <transition name="fade">
                                <span v-if="!priceBreakdown.paidDelivery" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div v-if="priceBreakdown.paymentMethod === 'Online payment (Stripe)'">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="card-element"><h3>Kreditná karta <i class="fas fa-credit-card"></i></h3></label>
                                <card-element @update:parent="errors = $event" :customer = customer :priceBreakdown = priceBreakdown></card-element>

                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="priceBreakdown.paymentMethod === 'PayPal' && customer.phone_number">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <PayPalCheckout :customer = customer :priceBreakdown = priceBreakdown></PayPalCheckout>
                        </div>
                    </div>
                </div>

                <div v-if="priceBreakdown.paymentMethod === 'Platba dobierkou' || priceBreakdown.paymentMethod === 'Money transfer'">
                    <div class="row">
                        <div class="col-md-12 form-group">
                                <button
                            type="submit"
                            class="button button--block button--teal button--squared"
                            @click="checkout()"
                            >Dokončite objednávku <i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="empty-basket-section"  v-else>

                <div class="col-sm-4 text-center my-center">

                        <i class="fas fa-cart-plus icon"></i>
                        <h3 class="mt-5"><strong>Your shopping cart is empty</strong></h3>
                        <h4>Add an item :)</h4>
                        <router-link :to="{name: 'obchod'}" class="button button--block button--squared  button--teal mt-5">Continue shopping <i class="fas fa-arrow-circle-left"></i></router-link>

                </div>

        </div>
    </div>

</template>
<script>
import validationErrors from "../shared/mixins/validationErrors";
import setCustomerAndTotalPrice from "../shared/mixins/beforeCheckout";

import { mapGetters, mapState } from 'vuex'
import CardElement from "../components/checkoutComponents/stripeComponents/CardElement";
import PayPalCheckout from "../components/checkoutComponents/payPalComponents/PayPalCheckout";

export default {
    mixins: [validationErrors, setCustomerAndTotalPrice],
    components:{
        CardElement,
        PayPalCheckout
    },
    data(){
        return{
            priceBreakdown:{
                paidDelivery: true,
                deliveryMethod: 'An Post',
                deliveryFee: 1.79,
                paymentMethod: "Money transfer",
                paymentFee: 0,
                calculatedTotalPrice: 0,
            },
            customer:{}
        }
    },

    created(){
        this.calculateTotalPrice();
    },

    computed:{
    ...mapGetters(['itemsInBasket', 'productsPrice']),
    ...mapState({
        basket:state => state.basket.items
        })
    },

    watch:{
        itemsInBasket: function(){
            this.calculateTotalPrice()
        },
        priceBreakdown:{
            handler: 'calculateTotalPrice',
            deep: true
        }
    },


    methods:{
        setPaymentFee(){
            this.priceBreakdown.paymentFee = this.priceBreakdown.paymentMethod === 'Platba dobierkou' ? 1.59 : 0;
        },
        setDeliveryFee(){
            if(this.priceBreakdown.paidDelivery){
                this.priceBreakdown.deliveryFee = this.priceBreakdown.deliveryMethod === 'An Post' ? 1.79 : 1.99;
            }else{
                this.priceBreakdown.deliveryFee = 0.00
            }
        },

        calculateTotalPrice(){
            this.setPaymentFee();
            this.setDeliveryFee();

            if(this.productsPrice >= 29.99){
                this.priceBreakdown.paidDelivery = false
                this.priceBreakdown.deliveryFee = 0
                this.priceBreakdown.calculatedTotalPrice = this.productsPrice + this.priceBreakdown.deliveryFee + this.priceBreakdown.paymentFee
            }else{
                this.priceBreakdown.calculatedTotalPrice = this.productsPrice + this.priceBreakdown.deliveryFee + this.priceBreakdown.paymentFee;
                this.priceBreakdown.paidDelivery = true
            }

        },

        async checkout(){
            this.errors = null
            this.setTotalPriceBreakdown(null);
            this.setCustomer(null);
            try {
                const response = await axios.post(`/api/checkout`, {customer: this.customer, priceBreakdown: this.priceBreakdown, basket: this.basket});
                if(response.data.status === 'success'){
                 this.setTotalPriceBreakdown(this.priceBreakdown);
                 this.setCustomer(this.customer);
                 this.$router.push({ name: "successfulCheckout" });
                }
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }
        },
    }
}
</script>
