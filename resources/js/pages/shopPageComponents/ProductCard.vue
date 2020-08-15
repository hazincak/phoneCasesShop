<template>
	<div class="card mr-2"> 
     	<div class="card-product">
			<router-link :to="{name: 'product', params: { id:product.id }}">
				<div class="img-wrap"><img src="../../../images/samples/Product1.jpg"></div>
			</router-link>	
			<div class="info-wrap">
					<router-link :to="{name: 'product', params: { id:product.id }}">
						<h6 class="card-title">{{product.title}}</h6>
					</router-link>
						
					
					<p class="card-text">{{product.model}}</p>
			</div>
			<div class="bottom-wrap">
				
				<button 
					v-if="inBasketAlready" 
					class="button button--teal-outline float-right"
					@click="removeFromBasket"
					> Remove</button>
				
				<button 
					v-else
					class="button button--teal-outline float-right"
					@click="addToBasket"><i class="fas fa-cart-arrow-down"></i> do košíka</button>	
				<div class="price-wrap h6">
					<span class="price-new">€{{product.price.toFixed(2)}} <p class="text-muted">s DPH.</p></span> 
				</div> 
				<hr>
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
      		this.$store.commit("addToBasket", {
        	product: this.product,
      			});
		},
		removeFromBasket(){
			this.$store.commit("removeFromBasket", this.product);
		}
	}	
};
</script>
