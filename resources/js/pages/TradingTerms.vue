<template>
    <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
    </div>
    <div v-else class="container mb-5">
        <b-breadcrumb>
            <router-link class="breadcrumb-link" :to="{name: 'home'}"> <i class="fas fa-home"></i> Home/</router-link>
            <b-breadcrumb-item active>Trading Terms & Conditions</b-breadcrumb-item>
        </b-breadcrumb>
        <h2 class="underlined-header mt-5">Trading Terms & Conditions</h2>
        <div class="row mt-5" v-if="!termsLoaded">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1 class="display-4">No Trading Terms & Conditions found!</h1>
                        <p class="lead">Enter your Trading Terms & Conditions in the admin section</p>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
        <div class="row mt-5" v-else>
            <div class="col-md-12">
                <span v-html="terms"></span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            termsLoaded: false,
            terms: null,
            loading: false,
        }
    },

    created(){
        this.loading = true
        axios.get(`/api/trading-terms-and-conditions`)
        .then(response => {
            if(200 == response.status && response.data.length > 0){
                this.terms = response.data[0].terms
                this.termsLoaded = true
            }else{
                this.termsLoaded = false
            }
        }).then(() => {
            this.loading = false
        })
    }
}
</script>
