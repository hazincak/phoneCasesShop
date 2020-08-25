<template>
    <div class="container">
        
        <div v-if="loading">
                Data is loading...
        </div>
        <div v-else>
            <breadcrumb></breadcrumb>
            <div class="row">
                <div class="col-mb-6">
                    <product-gallery :product="product"></product-gallery>
                </div>
                <div class="col-mb-6">
                      <h3>{{product.title}}</h3>
                    <h4>€{{product.price}} s DPH</h4>
                    <p>{{product.description}}</p>
                    <button 
			    		v-if="inBasketAlready" 
			    		class=" button button--teal float-right"
			    		@click="removeFromBasket"
			    		>odstrániť <i class="fas fa-trash-restore"></i></button>
    
			    	<button 
			    		v-else
			    		class="button button--teal-outline float-right"
			    		@click="addToBasket">do košíka <i class="fas fa-cart-arrow-down"></i></button>	
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="menu-items">
                        <li v-for="option in options" :key="option.title" :class="{active:option.title == selected}" :title="option.title" @click="selected = option.title" >{{option.title}}</li>
                        <!-- <li :class="{active: active}" @click="active = active">Podrobnosti</li> -->
                    </ul>
                    
                         <div class="description-area " v-if="selected == 'Popis'" >
                        
                            <small>
                            Stay connected either on the phone or the Web with the Galaxy S4 I337 from Samsung. With 16 GB of memory and a 4G connection, this phone stores precious photos and video and lets you upload them to a cloud or social network at blinding-fast speed. With a 17-hour operating life from one charge, this phone allows you keep in touch even on the go. 
        
                            With its built-in photo editor, the Galaxy S4 allows you to edit photos with the touch of a finger, eliminating extraneous background items. Usable with most carriers, this smartphone is the perfect companion for work or entertainment.
                            </small>
                      
                        </div>
                    
                        <div class="description-area " v-if="selected == 'Podrobnosti'">
                            
                                <table class="table">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Farba</th>
                                        <td>Cierna</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Material</th>
                                        <td>Jacob</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Model</th>
                                        <td>{{product.model}}</td>
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

<script>
import { mapState, mapGetters } from "vuex";
import ProductGallery from "./ProductGallery";
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