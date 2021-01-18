<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mt-5">Manage Returns & Refunds policies</h1>


                <div v-if="policiesLoaded">
                    <h2 class="mt-5 mb-5">Current Returns & Refunds policy</h2>
                    <span v-html="returnAndRefundPolicy"></span>
                    <button class=" mt-5 btn btn-primary btn-block btn-lg" :disabled='editMode' @click="editMode = true">Edit policies</button>

                </div>
                <div v-else>
                    <div class="form-group">
                        <label for="policies">Return & Refund Policy</label>
                        <froala
                            id="edit"
                            :tag="'textarea'"
                            :config="config"
                            rows="10"
                            name="policies"
                            v-model="returnAndRefundPolicy">
                        </froala>
                        <div class="error">{{createError}}</div>
                        <!-- <textarea
                            class="form-control"
                            placeholder="Enter your policies"
                            v-model="returnAndRefundPolicy"
                            name="policies"
                            rows="10"
                            :class="[{'is-invalid': errorFor('returnAndRefundPolicy')}]"
                            >
                        </textarea> -->
                            <v-errors :errors="errorFor('returnAndRefundPolicy')"></v-errors>

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
                        <!-- <v-errors :errors="errorFor('updatedPolicies')"></v-errors> -->

                        <!-- <textarea
                            class="form-control"
                            placeholder="Enter your policies"
                            v-model="updatedPolicies"
                            name="policies"
                            rows="10"
                            :class="[{'is-invalid': errorFor('updatedPolicies')}]"
                            >
                            </textarea> -->
                            <v-errors :errors="errorFor('updatedPolicies')"></v-errors>

                            <button class="mt-5 btn btn-success btn-block btn-lg" @click="updatePolicies()">Update policy</button>

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
        axios.get(`/api/returnAndRefundPolicy`)
        .then(response => {
            if(response.data){
                this.returnAndRefundPolicy = response.data[0].return_and_refund_policies
                this.policyId = response.data[0].id
                this.policiesLoaded = true
            }else{
                this.policiesLoaded = false
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
                if(200 == response.status){
                    console.log('displaying modal')
                }
            })
            .catch(err => {
                const errors = err.response.data.message;
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
                    this.id = response.data.id
                    this.policiesLoaded = true
                }
            })
            .catch(err=> {
                    const errors = err.response.data.message;
                    this.editError = errors;
                    return
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
