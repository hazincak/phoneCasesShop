 <template>

	<div class="card h-100">

			<router-link :to="{name: 'produkt', params: { id: product.id }}">
				<img :src='product.main_image.path' class="card-img-top">
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
								<em>{{product.model_name}}</em>
								<p><strong>€{{product.price.toFixed(2)}}</strong></p>
							</div>
							<button
								v-if="inBasketAlready"
								class=" button button--teal button--squared align-self-center"
								@click="removeFromBasket"
								>Delete <i class="fas fa-trash-restore"></i>
							</button>
							<button
								v-else
								class="button button--teal-outline button--squared align-self-center"
								@click="addToBasket">Add to basket <i class="fas fa-cart-arrow-down"></i>
							</button>
						</div>
					</div>

			</div>
	</div>
</template>
<script>
export default {

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
