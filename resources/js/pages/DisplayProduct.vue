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
                <router-link class="breadcrumb-link" :to="{name: 'home'}"> <i class="fas fa-home"></i> Home/</router-link>
                <router-link class="breadcrumb-link" :to="{name: 'shop'}">Shop/</router-link>
                <b-breadcrumb-item active>{{product.title}}</b-breadcrumb-item>
            </b-breadcrumb>
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <product-gallery :product="product"></product-gallery>
                </div>
                <div class="col-md-6 mt-5 d-flex flex-column">
                      <h2 class="mb-5 underlined-header">{{product.title}}</h2>
                        <div class="d-flex justify-content-between mb-5">
                            <div>
                                <strong>€{{product.price.toFixed(2)}} <span class="text-muted"></span></strong>
                            </div>
                            <div>
                                <em>{{product.model_name}}</em>
                            </div>
                        </div>
                    <p class="mt-5">{{product.description_short}}</p>
                    <button
			    		v-if="inBasketAlready"
			    		class=" mt-auto button button--block button--teal button--squared"
			    		@click="removeFromBasket"
			    		>delete <i class="fas fa-trash-restore"></i>
                    </button>

			    	<button
			    		v-else
			    		class="mt-auto button button--block button--teal-outline button--squared"
			    		@click="addToBasket">add to basket <i class="fas fa-cart-arrow-down"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="menu-items">
                        <li v-for="option in options" :key="option.title" :class="{active:option.title == selected}" :title="option.title" @click="selected = option.title" ><h4>{{option.title}}</h4></li>
                    </ul>

                         <div class="description-area text-left" v-if="selected == 'Description'" >{{product.description_long}}</div>

                        <div class="description-area text-center" v-if="selected == 'Details'">

                                <table class="table">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Colour</th>
                                        <td>{{product.color}}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Material</th>
                                        <td>{{product.material}}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Model</th>
                                        <td>{{product.model_name}}</td>
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
import ProductGallery from "../components/displayProductPageComponents/ProductGallery";
export default {
    components:{
        ProductGallery
    },

    data(){
        return{
            product: null,
            loading: false,
            options:[
                {title: 'Description'},
                {title: 'Details'},
            ],
            selected: 'Description',

        };
    },

    created(){
        this.loading=true;
        axios.get(`/api/shop/product-by-id/${this.$route.params.id}`)
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
            const mainImage = this.product.images[0];
            console.log(mainImage)
            var destructuredProduct = _.pick(this.product, ['id', 'title' ,'price']) ;
             destructuredProduct.main_image = mainImage;
      		this.$store.dispatch("addToBasket", {

        	product: destructuredProduct,
      			});
		},
		removeFromBasket(){
			this.$store.dispatch("removeFromBasket", this.product.id);
		}
	}
}
</script>
