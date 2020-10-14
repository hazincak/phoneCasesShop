<template>
	<!-- <div class="card-product m-5"> 
     	
			<router-link :to="{name: 'produkt', params: { id: product.id }}">
				<div class="img-wrap"><img :src='product.images[0].path'></div>
			</router-link>	
			<div class="card-product h-100 d-flex flex-column">
					<router-link :to="{name: 'produkt', params: { id: product.id }}">
						{{product.title}}
					</router-link>

					
					<div class="bottom-wrap mt-auto">
						<div>
							<p class="card-text">{{product.model.model_name}}</p>
						</div>
						<button 
							v-if="inBasketAlready" 
							class=" button button--teal button--squared float-right"
							@click="removeFromBasket"
							>odstrániť <i class="fas fa-trash-restore"></i></button>

						<button 
							v-else
							class="button button--teal-outline button--squared float-right"
							@click="addToBasket">do košíka <i class="fas fa-cart-arrow-down"></i></button>	
						<div class="price-wrap">
							<span class="price-new">€{{product.price.toFixed(2)}} <p class="text-muted">s DPH.</p></span> 
						</div> 
					</div> 
			</div>
	</div> -->
	<div class="card h-100"> 
     	
			<router-link :to="{name: 'produkt', params: { id: product.id }}">
				<img :src='product.images[0].path' class="card-img-top">
			</router-link>	
			<div class="card-body d-flex flex-column">
					<div class="p-2">
						<router-link class="card-title" :to="{name: 'produkt', params: { id: product.id }}">
						{{product.title}}
						</router-link>
					</div>
					<div class=" bottom-wrap mt-auto">
						<div class="d-flex justify-content-between">
							<div class="p-2">
								<em>{{product.model.model_name}}</em>
								<p><strong>€{{product.price.toFixed(2)}} <span class="text-muted"><small>s DPH.</small></span></strong></p>
							</div>
							<button 
								v-if="inBasketAlready" 
								class=" button button--teal button--squared align-self-center"
								@click="removeFromBasket"
								>odstrániť <i class="fas fa-trash-restore"></i>
							</button>
							<button 
								v-else
								class="button button--teal-outline button--squared align-self-center"
								@click="addToBasket">do košíka <i class="fas fa-cart-arrow-down"></i>
							</button>
						</div>
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
