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
                <h1>Manage Returns & Refunds Policies</h1>


                <div v-if="policiesLoaded">
                    <h2 class="mt-5 mb-5">Current Returns & Refunds Policy</h2>
                    <froala v-model="returnAndRefundPolicy"></froala>
                    <button class=" mt-5 btn btn-primary btn-block btn-lg" :disabled='editMode' @click="editMode = true">Edit Return & Refund Policies</button>
                    <div class="separator p-2">OR</div>
                    <button class=" mt-2 btn btn-danger btn-block btn-lg" :disabled='editMode' @click="onDeleteModal ()" >Delete Return & Refund Policies</button>
                </div>
                <div v-else>
                    <div class="form-group">
                        <label for="policies">Return & Refund Policy</label>
                        <div v-if="!policiesLoaded">
                            <froala
                            id="create"
                            :tag="'textarea'"
                            :config="config"
                            rows="10"
                            name="policies"
                            v-model="returnAndRefundPolicy">
                        </froala>
                        </div>
                        <div class="error">{{createError}}</div>
                        <button class="mt-5 btn btn-success btn-block btn-lg"  @click="createPolicies()">Create policy</button>
                    </div>
                </div>
                <div v-if="editMode" class="mt-5">
                    <h2 class="mt-5 mb-5">Update Policies</h2>
                    <div class="form-group" >
                        <froala
                            id="edit"
                            :tag="'textarea'"
                            :config="config"
                            name="policies"
                            v-model="updatedPolicies">
                        </froala>
                        <div class="error">{{editError}}</div>

                        <button class="mt-5 btn btn-success btn-block btn-lg" @click="updatePolicies()">Update policy</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueFroala from 'vue-froala-wysiwyg';
export default {
    data(){
        return{
            loading: false,

            returnAndRefundPolicy: null,
            policyId: null,
            updatedPolicies:null,
            policiesLoaded: false,
            editMode: false,

            editError: null,
            createError: null,

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
        axios.get(`/api/returnAndRefundPolicy`)
        .then(response => {
            if(200 == response.status && response.data.length > 0){
                    this.returnAndRefundPolicy = response.data[0].return_and_refund_policies
                    this.policyId = response.data[0].id
                    this.policiesLoaded = true
                    this.loading = false
                }else{
                    this.policiesLoaded = false
                    this.loading = false
                }
        })
    },

    methods: {
        createPolicies(){
            this.createError = null
            let policy = {
            'returnAndRefundPolicy': this.returnAndRefundPolicy
            }
            axios.post(`/api/returnAndRefundPolicy`, policy)
            .then(response => {
                if(201 == response.status){
                    // this.returnAndRefundPolicy = response.data.return_and_refund_policies;
                    this.policyId = response.data.id;
                    this.policiesLoaded = true;

                    this.flashMessage.info({
                        title: `Return & Refund policies created successfully`,
                        icon: false,
                   })
                }
            })
            .catch(err => {
                const errors = err.response.data.errors.returnAndRefundPolicy[0];
                  this.createError = errors;
                  return
                })
        },

        updatePolicies(){
            this.editError = null

            let policy = {
                'updatedPolicies': this.updatedPolicies
            }

            axios.put(`/api/returnAndRefundPolicy/${this.policyId}`, policy )
            .then(response => {
                if(200 == response.status){
                    this.flashMessage.info({
                        title: `Policies updated successfully`,
                        icon: false,
                   })
                    this.returnAndRefundPolicy = response.data.return_and_refund_policies
                    this.policyId = response.data.id
                    this.policiesLoaded = true
                    this.editMode = false

                }else{
                    this.policiesLoaded = false
                    this.loading = false
                }
            })
            .catch(err=> {
                    const errors = err.response.data.errors.updatedPolicies[0];
                    this.editError = errors;
                    return
                })
        },

        onDeleteModal(){
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want delete Return & Refund Policies?`, {
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
              this.deletePolicies(this.policyId)
            }
          })
          .catch(err => {
            // An error occurred
          })
        },

        deletePolicies(id){
            this.loading = true;
            axios.delete(`/api/returnAndRefundPolicy/${id}`)
            .then(response => {
                this.loading = false;
                this.returnAndRefundPolicy = null;
                this.policiesLoaded = false;
                this.policyId = null;
                this.flashMessage.error({
                    title: 'Return & Refund policies successfully deleted'
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
