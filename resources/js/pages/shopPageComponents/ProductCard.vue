<template>
	<div class="card mr-2"> 
     	<div class="card-product">
			<router-link :to="{name: 'product', params: { id }}">
				<div class="img-wrap"><img src="../../../images/samples/Product1.jpg"></div>
			</router-link>	
			<div class="info-wrap">
					<router-link :to="{name: 'product', params: { id }}">
						<h6 class="card-title">{{title}}</h6>
					</router-link>
						
					
					<p class="card-text">{{model}}</p>
			</div>
			<div class="bottom-wrap">
				<a href="" class="button button--teal-outline float-right"><i class="fas fa-cart-arrow-down"></i> do košíka</a>	
				<div class="price-wrap h6">
					<span class="price-new">€{{price.toFixed(2)}} <p class="text-muted">s DPH.</p></span> 
				</div> 
				<hr>
			</div> 
    	</div>
	</div>
</template>
<script>
export default {
    props: {"model":String, "title":String, "price":Number, "id":Number}
};
</script>