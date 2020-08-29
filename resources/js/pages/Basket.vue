<template>
    <div class="container">
        <breadcrumb></breadcrumb>
        <div class="row" v-if="itemsInBasket">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="first_name">Meno</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="first_name" 
                       >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Priezvisko</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="last_name" 
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
                        >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">Mesto</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="city" 
                        >

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 form-group">
                  <div class="input-group-prepend">
                    <label for="county">Kraj</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01">
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
                        >
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button 
                        type="submit" 
                        class="button button--block button--teal" 
                        >Dokončite objednávku <i class="fas fa-check"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase text-secondary font-weight-bolder">nákupný košík</h6>
                    <h6 class="badge badge-secondary text-uppercase">
                        <span>Počet: {{itemsInBasket}}</span>
                    </h6>
                </div>
                <div>
                    <transition-group name="fade">
                    <div v-for="item in basket" :key="item.product.id" class="pt-2 pb-2 border-top d-flex justify-content-between">
                           <div class="p-2 "><img class="img-fluid basket__img" :src='item.product.images[0].path' alt=""></div>
                           <div class="d-flex align-items-center">
                               <router-link :to="{name: 'produkt', params: {id: item.product.id}}">{{item.product.title}}</router-link>
                           </div>
                        
                        <!-- <div class="pt-2 pb-2 text-right"> -->
                        <div class="d-flex align-items-center">    
                            <span class="font-weight-bold">€{{item.product.price}}</span>
                        </div>
                        <div class="d-flex align-items-center">   
                                <button class="btn btn-sm btn-outline-secondary" @click="$store.dispatch('removeFromBasket', item.product.id)">
                                <i class="fas fa-trash-alt"></i>
                                </button>
                        
                            
                        </div> 
                        <!-- </div> -->
                    </div>
                    </transition-group>
                </div>
            </div>
        </div>
    
    
        <div class="empty-basket-section"  v-else>
            
                <div class="col-sm-4 text-center my-center"> 
                    
                        <i class="fas fa-cart-plus icon"></i>
                        <h3><strong>Váš košík je prázdny</strong></h3>
                        <h4>Pridajte tovar a dokončite nákup :)</h4> 
                        <router-link :to="{name: 'obchod'}" class="button button--block button--teal">pokračujte v nákupe <i class="fas fa-arrow-circle-left"></i></router-link>
                    
                </div>
            
        </div>
    </div>
    
</template>
<script>
import { mapGetters, mapState } from 'vuex'
export default {
    computed:{
    ...mapGetters(['itemsInBasket']),
    ...mapState({
        basket:state => state.basket.items
        })
    }
}
</script>

<style scoped>
.container{
    min-height: 75vh;
}

</style>