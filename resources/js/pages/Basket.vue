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
                        <h3 class="text-uppercase  font-weight-bolder">výpočet ceny</h3>
                    </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Medzisúčet</h4> 
                            <h4>€{{productsPrice.toFixed(2)}}</h4> 
                        </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Doprava</h4> 
                            <h4>
                                
                                <div v-if="priceBreakdown.paidDelivery">
                                     €{{priceBreakdown.deliveryFee}}
                                </div>
                                <div v-else>
                                    ZADARMO
                                </div>
                            </h4>
                        </div>
                        <div v-if="priceBreakdown.paymentMethod === 'Platba dobierkou'">
                            <div class="d-flex border-top p-2 justify-content-between">
                                <h4 class="text-secondary">Platba dobierkou</h4> 
                                <h4>
                                    €{{priceBreakdown.paymentFee}}
                                </h4> 
                            </div>
                        </div>
                        <div class="d-flex border-top p-2 justify-content-between">
                            <h4 class="text-secondary">Cena spolu</h4> 
                            <h4>
                                    €{{priceBreakdown.calculatedTotalPrice.toFixed(2)}}
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
                        :class="[{'is-invalid': errorFor('customer.first_name')}]"
                       >
                       <v-errors :errors="errorFor('customer.first_name')"></v-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Priezvisko</label>
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
                        <label for="phoneNumber">Telefónne číslo</label>
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
                        <label for="street_name">Názov ulice</label>
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
                        <label for="street_number">Číslo ulice</label>
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
                        <label for="city">Mesto</label>
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
                    <label for="county">Kraj</label>
                  </div>
                  <select 
                    class="custom-select" 
                    id="inputGroupSelect01" 
                    v-model="customer.county"
                    :class="[{'is-invalid': errorFor('customer.county')}]"  
                    >
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
                        :class="[{'is-invalid': errorFor('customer.zip')}]"   
                        >
                        <v-errors :errors="errorFor('customer.zip')"></v-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h3>Platba <i class="far fa-money-bill-alt"></i></h3>
                        
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment" id="payment1" v-model='priceBreakdown.paymentMethod' value="Platba prevodom na účet" >
                          <label class="form-check-label" for="payment1">
                            Platba prevodom na účet 
                            <transition name="fade">
                                <span v-if="priceBreakdown.paymentMethod === 'Platba prevodom na účet'" class="badge badge-secondary">€0,00</span>
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
                          <input class="form-check-input" type="radio" name="payment" id="payment3" v-model='priceBreakdown.paymentMethod' value="Platba kartou online">
                          <label class="form-check-label" for="payment3">
                            Platba kartou online
                            <transition name="fade">
                                <span v-if="priceBreakdown.paymentMethod === 'Platba kartou online'" class="badge badge-secondary">€0,00</span>
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
                        <h3>Spôsob dopravy <i class="fas fa-shuttle-van"></i></h3>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliverymethod" id="deliveryMethod1" v-model='priceBreakdown.deliveryMethod' value="Slovenská pošta" :disabled = '!priceBreakdown.paidDelivery'>
                          <label class="form-check-label" for="deliveryMethod1">
                            Pri doprave Slovenskou poštou 
                            <transition name="fade">
                                <span v-if="priceBreakdown.deliveryMethod === 'Slovenská pošta'" class="badge badge-secondary">€1,79</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethod2" v-model='priceBreakdown.deliveryMethod' value="Kuriérska spoločnosť" :disabled = '!priceBreakdown.paidDelivery'>
                          <label class="form-check-label" for="deliveryMethod2">
                            Pri doprave kuriérskou spoločnosťou 
                            <transition name="fade">
                                <span v-if="priceBreakdown.deliveryMethod === 'Kuriérska spoločnosť'" class="badge badge-secondary">€1,99</span>
                            </transition>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryMethod3" v-model='priceBreakdown.deliveryFee' :value=0 :disabled = 'priceBreakdown.paidDelivery'>
                          <label class="form-check-label" for="deliveryMethod3">
                            Pri nákupe nad 29,99 €: doručenie ZADARMO 
                            <transition name="fade">
                                <span v-if="!priceBreakdown.paidDelivery" class="badge badge-secondary">€0,00</span>
                            </transition>
                          </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div v-if="priceBreakdown.paymentMethod === 'Platba kartou online'">
                    <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="card-element"><h3>Kreditná karta <i class="fas fa-credit-card"></i></h3></label>
                        <card-element @update:parent="errors = $event" :customer = customer :priceBreakdown = priceBreakdown></card-element>
                        
                    </div>
                </div>
                </div>
                </div>
                
                 
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div v-if="priceBreakdown.paymentMethod === 'Platba dobierkou' || priceBreakdown.paymentMethod === 'Platba prevodom na účet'">
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
import validationErrors from "../shared/mixins/validationErrors";
import { mapGetters, mapState } from 'vuex'
import CardElement from "../components/stripeComponents/CardElement";
export default {
    mixins: [validationErrors],
    components:{
        CardElement
    },
    data(){
        return{
            priceBreakdown:{
                paidDelivery: true,
                deliveryMethod: 'Slovenská pošta',
                deliveryFee: 1.79,
                paymentMethod: "Platba prevodom na účet",
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
                this.priceBreakdown.deliveryFee = this.priceBreakdown.deliveryMethod === 'Slovenská pošta' ? 1.79 : 1.99;
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
            
        }
    }
}
</script>
