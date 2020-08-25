<template>
	<div class="card card-product mr-2 mb-4"> 
     	
			<router-link :to="{name: 'produkt', params: { id: product.id }}">
				<div class="img-wrap"><img src="../../../images/samples/Product1.jpg"></div>
			</router-link>	
			<div>
					<router-link :to="{name: 'produkt', params: { id: product.id }}">
						<h6 class="card-title">{{product.title}}</h6>
					</router-link>
						
					
					<p class="card-text">{{product.model}}</p>
			</div>
			<div class="bottom-wrap pt-3">
				<button 
					v-if="inBasketAlready" 
					class=" button button--teal float-right"
					@click="removeFromBasket"
					>odstrániť <i class="fas fa-trash-restore"></i></button>
				
				<button 
					v-else
					class="button button--teal-outline float-right"
					@click="addToBasket">do košíka <i class="fas fa-cart-arrow-down"></i></button>	
				<div class="price-wrap h6">
					<span class="price-new">€{{product.price.toFixed(2)}} <p class="text-muted">s DPH.</p></span> 
				</div> 
			</div> 
    	
	</div>
</template>
<script>
import { mapState, mapGetters } from "vuex";
export default {
	

	// props: {"model":String, "title":String, "price":Number, "id":Number}
	props:{"product":Object},

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
};
</script>
