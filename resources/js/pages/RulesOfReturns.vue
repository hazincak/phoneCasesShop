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
            <b-breadcrumb-item active>Returns & Refunds policy</b-breadcrumb-item>
        </b-breadcrumb>
        <h2 class="underlined-header mt-5">Returns & Refunds policy</h2>
          <div class="row mt-5" v-if="!policiesLoaded">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1 class="display-4">No Return & Refund Policies found!</h1>
                        <p class="lead">Enter your Return & Refund Policies in the admin section</p>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
        <div class="row mt-5" v-else>
                <div class="col-md-8">
                    <span v-html="returnAndRefundPolicy"></span>
                </div>
                <div class="col-md-4">
                    <div class="row mb-4">
                        <h3>Download Return & Refund protocol</h3>
                        <a class="link" @click="download()"><i class="fas fa-file-download"></i> reklamacny-protokol.pdf</a>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
export default {
     data(){
        return{
            returnAndRefundPolicy: null,
            policiesLoaded: false,
            loading: false,
            returnsProtocol: 'reklamacny-protokol.pdf'
        };
    },

    created(){
       this.loading = true;
       axios.get(`/api/returnAndRefundPolicy`)
        .then(response => {
            if(200 == response.status && response.data.length > 0){
                this.returnAndRefundPolicy = response.data[0].return_and_refund_policies
                this.policiesLoaded = true
            }else{
                this.policiesLoaded = false
            }
        })
        .then(() => {
            this.loading = false
        })
    },

    methods:{
        download() {
        axios.get(`api/stiahnut-pdf/${this.returnsProtocol}`, {responseType: 'arraybuffer'})
        .then(response => {
        this.downloadFile(response, this.returnsProtocol)
    }, response => {
        console.warn('error from download_contract')
        console.log(response)
    })
    },
        downloadFile(response, filename) {

    var newBlob = new Blob([response.data], {type: 'application/pdf'})
    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
      window.navigator.msSaveOrOpenBlob(newBlob)
      return
    }

    const data = window.URL.createObjectURL(newBlob)
    var link = document.createElement('a')
    link.href = data
    link.download = filename + '.pdf'
    link.click()
    setTimeout(function () {
      // For Firefox it is necessary to delay revoking the ObjectURL
      window.URL.revokeObjectURL(data)
    }, 100)
        },
    }
}
</script>
