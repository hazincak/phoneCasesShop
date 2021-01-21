<template>
    <div>
        <div v-if="loading">
            <atom-spinner class="my-center"
              :animation-duration="1000"
              :size="80"
              :color="'#086972'"
            />
        </div>
        <div v-else class="row justify-content-center">
            <div class="col-md-8">
                <h1 >Manage Trading Terms & Conditions</h1>
                <div v-if="termsLoaded">
                    <h2 class="mt-5 mb-5">Trading Terms & Conditions</h2>
                    <span v-html="terms"></span>
                    <button class=" mt-5 btn btn-primary btn-block btn-lg" :disabled='editMode' @click="editMode = true">Edit Trading Terms & Conditions</button>
                    <div class="separator p-2">OR</div>
                    <button class=" mt-2 btn btn-danger btn-block btn-lg" :disabled='editMode' @click="onDeleteModal ()" >Delete Trading Terms & Conditions</button>
                </div>
                <div v-else>
                    <div class="form-group">
                        <label for="tradingTerms">Terms & Conditions</label>
                        <div v-if="!termsLoaded">
                            <froala
                            id="edit"
                            :tag="'textarea'"
                            :config="config"
                            rows="10"
                            name="tradingTerms"
                            v-model="terms">
                            </froala>
                        </div>
                        <div class="error">{{createError}}</div>
                        <button class="mt-5 btn btn-success btn-block btn-lg"  @click="createTradingTerms()">Create Terms & Conditions</button>
                    </div>
                </div>
                <div v-if="editMode" class="mt-5">
                    <h2 class="mt-5 mb-5">Update Terms & Conditions</h2>
                    <div class="form-group" >
                        <label for="updateTerms">Update terms</label>
                        <froala
                            id="edit"
                            :tag="'textarea'"
                            :config="config"
                            name="updateTerms"
                            v-model="updatedTerms">
                        </froala>
                        <div class="error">{{editError}}</div>

                            <button class="mt-5 btn btn-success btn-block btn-lg" @click="updatePolicies()">Update Trading Terms & Conditions</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueFroala from 'vue-froala-wysiwyg';
import validationErrors from "../../../shared/mixins/validationErrors";
export default {
    mixins:[validationErrors],
    data(){
        return{
            loading: false,

            terms: null,
            termsId: null,
            updatedTerms:null,
            termsLoaded: false,
            editMode: false,

            editError: null,
            createError: null,

            confirmedDeletion: '',

            //froala
            config: {
                events: {
                    initialized: function () {
                    console.log('initialized')
                    }
                }
            }
        }
    },

    created(){
        this.loading = true
        axios.get(`/api/trading-terms-and-conditions`)
        .then(response => {
            console.log(response.data)
            if(200 == response.status && response.data.length > 0){
                this.terms = response.data[0].terms
                this.termsId = response.data[0].id
                this.termsLoaded = true
                this.loading = false
            }else{
                this.termsLoaded = false
                this.loading = false
            }
        })
    },

    methods: {
        createTradingTerms(){
            this.createError = null

            let terms = {
            'tradingTerms': this.terms
            }

            axios.post(`/api/trading-terms-and-conditions`, terms)
            .then(response => {
                if(201 == response.status){
                    this.termsId = response.data.id;
                    this.termsLoaded = true;
                    this.flashMessage.info({
                        title: `Trading Terms & Conditions created successfully`,
                        icon: false,
                   })
                }
            })
            .catch(err => {
                const errors = err.response.data.errors.tradingTerms[0];
                  this.createError = errors;
                  return
                })
        },

        updatePolicies(){
            this.editError = null

            let updatedTerms = {
                'updatedTerms': this.updatedTerms
            }

            axios.put(`/api/trading-terms-and-conditions/${this.termsId}`, updatedTerms )
            .then(response => {
                if(200 == response.status){
                    this.flashMessage.info({
                          title: `Trading Terms updated successfully`,
                          icon: false,
                    })
                    this.terms = response.data.terms
                    this.termsId = response.data.id
                    this.termsLoaded = true
                    this.editMode = false
                }
            })
            .catch(err=> {
                    const errors = err.response.data.errors.updatedTerms[0];
                    this.editError = errors;
                    return
                })
        },

        onDeleteModal(){
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want delete Trading Terms & Conditions?`, {
          title: 'Please confirm',
          size: 'md',
          buttonSize: 'md',
          okVariant: 'danger',
          okTitle: 'Yes',
          cancelTitle: 'No',
          footerClass: 'p-2',
          hideHeaderClose: false,
          centered: true
        })
          .then(value => {
            this.confirmedDeletion = value
            if(this.confirmedDeletion){
              this.deleteTerms(this.termsId)
            }
          })
          .catch(err => {
            // An error occurred
          })
        },

        deleteTerms(id){
            this.loading = true;
            axios.delete(`/api/trading-terms-and-conditions/${id}`)
            .then(response => {
                this.loading = false;
                this.terms = null;
                this.termsLoaded = false;
                this.flashMessage.error({
                    title: 'Trading Terms & Conditions successfully deleted'
                })
            })
        }
    }

}
</script>
<style scoped>
    .error{
        color: red;
        font-size: 80%;
    }
</style>
