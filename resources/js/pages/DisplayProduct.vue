<template>
    <div class="container">
        
        <div v-if="loading">
                <atom-spinner class="my-center"
                :animation-duration="1000"
                :size="80"
                :color="'#086972'"
            />
        </div>
        <div v-else>
            <b-breadcrumb>
                <router-link class="breadcrumb-link" :to="{name: 'domov'}"> <i class="fas fa-home"></i> Domov/</router-link>
                <router-link class="breadcrumb-link" :to="{name: 'obchod'}">Obchod/</router-link>
                <b-breadcrumb-item active>{{product.title}}</b-breadcrumb-item>
            </b-breadcrumb>
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <product-gallery :product="product"></product-gallery>
                </div>
                <div class="col-md-6 mt-5">
                      <h2 class="mb-5">{{product.title}}</h2>
                        <div class="d-flex justify-content-between mb-5">
                            <div>
                                <h4>€{{product.price}} <span class="price"> s DPH</span></h4>
                            </div>
                            <div>
                                <h4>{{product.model.model_name}}</h4>
                            </div>
                        </div>
                    <p class="mb-5">{{product.description_short}}</p>
                    <button 
			    		v-if="inBasketAlready" 
			    		class=" button button--block button--teal float-right"
			    		@click="removeFromBasket"
			    		>odstrániť <i class="fas fa-trash-restore"></i></button>
    
			    	<button 
			    		v-else
			    		class="button button--block button--teal-outline"
			    		@click="addToBasket">do košíka <i class="fas fa-cart-arrow-down"></i></button>	
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="menu-items">
                        <li v-for="option in options" :key="option.title" :class="{active:option.title == selected}" :title="option.title" @click="selected = option.title" >{{option.title}}</li>
                        <!-- <li :class="{active: active}" @click="active = active">Podrobnosti</li> -->
                    </ul>
                    
                         <div class="description-area text-center" v-if="selected == 'Popis'" >{{product.description_long}}</div>
                    
                        <div class="description-area text-center" v-if="selected == 'Podrobnosti'">
                            
                                <table class="table">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Farba</th>
                                        <td>{{product.color.color}}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Material</th>
                                        <td>{{product.material.material}}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Model</th>
                                        <td>{{product.model.model_name}}</td>
                                      </tr>
                                    </tbody>
                                </table>
                            
                        </div> 
                        <!-- Podrobnosti -->   
                </div>
                <!-- col.md-12 -->
            </div>
            <!-- row -->
        </div>
        <!-- v-else  -->
    </div>
    <!-- container  -->
</template>

<style scoped>
.price{
    color: grey;
    
}
</style>>

</style>

<script>
import { mapState, mapGetters } from "vuex";
import ProductGallery from "./displayProductPageComponents/ProductGallery";
export default {
    components:{
        ProductGallery
    },

    data(){
        return{
            product: null,
            loading: false,
            options:[
                {title: 'Popis'},
                {title: 'Podrobnosti'},
            ],
            selected: 'Popis',
            
        };
    },

    created(){
        this.loading=true;
        axios.get(`/api/obchod/produkt-podla-id/${this.$route.params.id}`)
            .then(response => {
                this.product = response.data
                this.loading = false;
            });
    },

    computed: {
		inBasketAlready() {
      if (null === this.product) {
        return false;
      }
      return this.$store.getters.inBasketAlready(this.product.id);
    }
    },
    
    methods: {
		addToBasket() {
      		this.$store.dispatch("addToBasket", {
        	product: this.product,
      			});
		},
		removeFromBasket(){
			this.$store.dispatch("removeFromBasket", this.product.id);
		}
	}	
}
</script>