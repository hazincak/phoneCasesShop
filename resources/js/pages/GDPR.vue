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
            <b-breadcrumb-item active>General Data Protection Regulation</b-breadcrumb-item>
        </b-breadcrumb>
        <h2 class="underlined-header mt-5">General Data Protection Regulation</h2>
        <div class="row mt-5" v-if="!gdprLoaded">
                   <div class="col-md-12">
                    <div class="jumbotron">
                        <h1 class="display-4">No GDPR found!</h1>
                        <p class="lead">Enter your General Data Protection Regulation Terms in the admin section</p>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
        <div class="row mt-5" v-else>
                <div class="col-md-12">
                    <span v-html="gdpr"></span>
                </div>
        </div>
    </div>
</template>

<script>
export default {
     data(){
        return{
            gdpr: null,
            gdprLoaded: false,
            loading: false,
        };
    },

    created(){
       this.loading = true;
       axios.get(`/api/gdpr`)
        .then(response => {
            if(200 == response.status && response.data.length > 0){
                this.gdpr = response.data[0].gdpr
                this.gdprLoaded = true
            }else{
                this.gdprLoaded = false
            }
        })
        .then(() => {
            this.loading = false
        })
    },

    methods:{

    }

}
</script>
