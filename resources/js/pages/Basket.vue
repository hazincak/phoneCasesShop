<template>
    <div class="container">
        <b-breadcrumb>
            <router-link class="breadcrumb-link" :to="{name: 'domov'}"> <i class="fas fa-home"></i> Domov/</router-link>
            <router-link class="breadcrumb-link" :to="{name: 'obchod'}">Obchod/</router-link>
            <b-breadcrumb-item active>Košík</b-breadcrumb-item>
        </b-breadcrumb>
        <div class="row mt-5" v-if="itemsInBasket">
            <div class="col-md-5 order-md-2">
                <div class="d-flex justify-content-between">
                    <h3 class="text-uppercase  font-weight-bolder">nákupný košík</h3>
                    <h3 class="badge badge-secondary text-uppercase">
                        <span>Počet: {{itemsInBasket}}</span>
                    </h3>
                </div>
                <div>
                    <transition-group name="fade">
                    <div v-for="item in basket" :key="item.product.id" class="basket pt-2 pb-2 border-top d-flex justify-content-between">
                           <div class="p-2 "><img class="img-fluid basket__img" :src='item.product.images[0].path' alt=""></div>
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
                        <h3 class="text-uppercase  font-weight-bolder">výpočet ceny</h3>
                    </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Medzisúčet</h4> 
                            <h4>€{{totalPrice.toFixed(2)}}</h4> 
                        </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Doprava</h4> 
                            <h4>
                                
                                <div v-if="paidDelivery">
                                     €{{deliveryFee}}
                                </div>
                                <div v-else>
                                    ZADARMO
                                </div>
                            </h4>
                        </div>
                        <div v-if="paymentMethod === 'PayWhenDelivered'">
                            <div class="d-flex border-top p-2 justify-content-between">
                                <h4 class="text-secondary">Platba dobierkou</h4> 
                                <h4>
                                    €{{paymentFee}}
                                </h4> 
                            </div>
                        </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Cena spolu</h4> 
                            <h4>
                                    €{{calculatedTotalPrice.toFixed(2)}}
                            </h4> 
                        </div>
                
                    
                    
                        
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6  form-group">
                        <label for="first_name">Meno</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="first_name" 
                        v-model="customer.first_name"
                       >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Priezvisko</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="last_name"
                        v-model="customer.last_name" 
                        >
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
                         >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="street">Ulica</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="street" 
                        v-model="customer.street"
                        >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">Mesto</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="city" 
                        v-model="customer.city"
                        >

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 form-group">
                  <div class="input-group-prepend">
                    <label for="county">Kraj</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" v-model="customer.county">
                    <option selected>Vyberte kraj</option>
                    <option>Bratislavský kraj</option>
                    <option>Trnavský kraj</option>
                    <option>Trenčiansky kraj</option>
                    <option>Nitriansky kraj</option>
                    <option>Žilinský kraj</option>
                    <option>Banskobystrický kraj</option>
                    <option>Prešovský kraj</option>
                    <option>Košický kraj</option>
                  </select>
                </div>
                    <div class="col-md-4 form-group">
                        <label for="zip">PSČ</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="zip"
                        v-model="customer.zip" 
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h3>Platba <i class="far fa-money-bill-alt"></i></h3>
                        
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment1" v-model='paymentMethod' value="MoneyTransfer" >
                          <label class="form-check-label" for="payment1">
                            Platba prevodom na účet 
                            <transition name="fade">
                                <span v-if="paymentMethod === 'MoneyTransfer'" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment2"  v-model='paymentMethod' value="PayPal">
                          <label class="form-check-label" for="payment2">
                            PayPal
                            <transition name="fade">
                                <span v-if="paymentMethod === 'PayPal'" class="badge badge-secondary">€0,00</span>
                            </transition>     
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment3" v-model='paymentMethod' value="CreditCard">
                          <label class="form-check-label" for="payment3">
                            Platba kartou online
                            <transition name="fade">
                                <span v-if="paymentMethod === 'CreditCard'" class="badge badge-secondary">€0,00</span>
                            </transition> 
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment4" v-model='paymentMethod' value="PayWhenDelivered">
                          <label class="form-check-label" for="payment4">
                            Platba dobierkou (pri preberaní tovaru) 
                            <transition name="fade">
                                <span v-if="paymentMethod === 'PayWhenDelivered'" class="badge badge-secondary">€1,59</span> 
                            </transition>
                          </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h3>Spôsob dopravy <i class="fas fa-shuttle-van"></i></h3>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryFee" id="deliveryFee1" v-model='deliveryFee' :value="1.79" :disabled = '!paidDelivery'>
                          <label class="form-check-label" for="deliveryFee1">
                            Pri doprave Slovenskou poštou 
                            <transition name="fade">
                                <span v-if="deliveryFee === 1.79" class="badge badge-secondary">€1,79</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryFee" id="deliveryFee2" v-model='deliveryFee' :value="1.99" :disabled = '!paidDelivery'>
                          <label class="form-check-label" for="deliveryFee2">
                            Pri doprave kuriérskou spoločnosťou 
                            <transition name="fade">
                                <span v-if="deliveryFee === 1.99" class="badge badge-secondary">€1,99</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryFee" id="deliveryFee3" v-model='deliveryFee' :value="0" :disabled = 'paidDelivery'>
                          <label class="form-check-label" for="deliveryFee3">
                            Pri nákupe nad 29,99 €: doručenie ZADARMO 
                            <transition name="fade">
                                <span v-if="deliveryFee === 0" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div v-if="paymentMethod === 'CreditCard'">
                    <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="card-element"><h3>Kreditná karta <i class="fas fa-credit-card"></i></h3></label>
                        <card-element :customer = customer :priceToBePaid = calculatedTotalPrice.toFixed(2)></card-element>
                        
                    </div>
                </div>
                </div>
                </div>
                
                 
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div v-if="paymentMethod === 'PayWhenDelivered' || paymentMethod === 'MoneyTransfer'">
                            <button 
                        type="submit" 
                        class="button button--block button--teal button--squared" 
                        >Dokončite objednávku <i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <div class="empty-basket-section"  v-else>
            
                <div class="col-sm-4 text-center my-center"> 
                    
                        <i class="fas fa-cart-plus icon"></i>
                        <h3 class="mt-5"><strong>Váš košík je prázdny</strong></h3>
                        <h4>Pridajte tovar a dokončite nákup :)</h4> 
                        <router-link :to="{name: 'obchod'}" class="button button--block button--squared  button--teal mt-5">pokračujte v nákupe <i class="fas fa-arrow-circle-left"></i></router-link>
                    
                </div>
            
        </div>
    </div>
    
</template>
<script>
import { mapGetters, mapState } from 'vuex'
import CardElement from "../components/stripeComponents/CardElement";
export default {
    components:{
        CardElement
    },
    data(){
        return{
            deliveryFee: 1.79,
            paymentMethod: "MoneyTransfer",
            paymentFee: 0,
            paidDelivery: true,
            calculatedTotalPrice: 0,
            customer:{}
        }
    },

    created(){
        this.calculateTotalPrice();
    },

    computed:{
    ...mapGetters(['itemsInBasket', 'totalPrice']),
    ...mapState({
        basket:state => state.basket.items
        })
    },

    watch:{
        itemsInBasket: function(){
            this.calculateTotalPrice()
        },
        deliveryFee: function(){
            this.calculateTotalPrice()
        },
        paymentMethod: function(){
            if(this.paymentMethod === 'MoneyTransfer' || this.paymentMethod === 'PayPal' || this.paymentMethod === 'CreditCard' ){
                this.paymentFee = 0
            }else if(this.paymentMethod === 'PayWhenDelivered'){
                this.paymentFee = 1.59
                this.calculateTotalPrice()
            }
        },
        paymentFee: function(){
            this.calculateTotalPrice()
        }
    },

   
    methods:{
        calculateTotalPrice(){
            if(this.totalPrice >= 29.99){
                this.paidDelivery = false
                this.deliveryFee = 0
                this.calculatedTotalPrice = this.totalPrice + this.deliveryFee + this.paymentFee
            }else{
                this.calculatedTotalPrice = this.totalPrice + this.deliveryFee + this.paymentFee;
                this.paidDelivery = true
            }
            
        }
    }
}
</script>
