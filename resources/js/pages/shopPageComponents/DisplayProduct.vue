<template>
    <div class="container">
        <bread-crumbs></bread-crumbs>
        <div class="row">
            <div class="col-mb-6">
                <img src="./../../../images/samples/Product3.jpg" alt="">
            </div>
            <div class="col-mb-6">
                  <h3>{{product.title}}</h3>
                <p>{{product.description}}</p>
            </div>     
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            product: null,
            loading: false,
        };
    },

    created(){
        this.loading=true;
        axios.get(`/api/shop/product-by-id/${this.$route.params.id}`)
            .then(response => {
                this.product = response.data
                this.loading = false;
            });
    }
}
</script>