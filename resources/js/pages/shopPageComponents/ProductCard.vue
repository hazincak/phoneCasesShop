<template>
	<div class="card mr-2 text-center"> 
     	<div class="card-product">
			<div class="img-wrap"><img src="../../../images/samples/Product1.jpg"></div>
			<div class="info-wrap">
					<h5 class="title">{{title}}</h5>
					<p class="desc">{{description}}</p>
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
    props: {"title":String, "description":String, "price":Number}
};
</script>