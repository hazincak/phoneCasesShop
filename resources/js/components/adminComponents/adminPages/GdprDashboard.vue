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
                <h1 class="mt-5">Manage General Data Protection Regulation Rules</h1>
                <div v-if="gdprLoaded">
                    <h2 class="mt-5 mb-5">General Data Protection Regulation</h2>
                    <span v-html="gdpr"></span>
                    <button class=" mt-5 btn btn-primary btn-block btn-lg" :disabled='editMode' @click="editMode = true">Edit General Data Protection Regulation Rules</button>
                     <div class="separator p-2">OR</div>
                    <button class=" mt-2 btn btn-danger btn-block btn-lg" :disabled='editMode' @click="onDeleteModal ()" >Delete General Data Protection Regulation Rules</button>
                </div>
                <div v-else>
                    <div class="form-group">
                        <label for="gdpr">GDPR</label>
                        <div v-if="!gdprLoaded">
                            <froala
                                id="create"
                                :tag="'textarea'"
                                :config="config"
                                rows="10"
                                name="gdpr"
                                v-model="gdpr">
                            </froala>
                        </div>
                        <div class="error">{{createError}}</div>
                        <button class="mt-5 btn btn-success btn-block btn-lg"  @click="createGDPR()">Create GDPR</button>
                    </div>
                </div>
                <div v-if="editMode" class="mt-5">
                    <h2 class="mt-5 mb-5">Update GDPR</h2>
                    <div class="form-group" >
                        <label for="updateGdpr">Update GDPR</label>
                        <froala
                            id="edit"
                            :tag="'textarea'"
                            :config="config"
                            name="updateGdpr"
                            v-model="updatedGdpr">
                        </froala>
                        <div class="error">{{editError}}</div>

                            <button class="mt-5 btn btn-success btn-block btn-lg" @click="updateGDPR()">Update Trading GDPR</button>

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

            gdpr: null,
            gdprId: null,
            updatedGdpr:null,
            gdprLoaded: false,
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
        axios.get(`/api/gdpr`)
        .then(response => {
            console.log(response.data)
            if(200 == response.status && response.data.length > 0){
                    this.gdpr = response.data[0].gdpr
                    this.gdprId = response.data[0].id
                    this.gdprLoaded = true
                    this.loading = false
            }else{
                this.gdprLoaded = false
                this.loading = false
            }
        })
    },

    methods: {
        createGDPR(){
            this.createError = null

            let gdpr = {
            'gdprRules': this.gdpr
            }

            axios.post(`/api/gdpr`, gdpr)
            .then(response => {
                if(201 == response.status){

                    this.gdprId = response.data.id;
                    this.gdprLoaded = true;

                    this.flashMessage.info({
                        title: ` General Data Protection Regulation Rules created successfully`,
                        icon: false,
                   })
                }
            })
            .catch(err => {
                const errors = err.response.data.errors.gdprRules[0];
                  this.createError = errors;
                  return
                })
        },

        updateGDPR(){
            this.editError = null

            let updatedRules = {
                'updatedRules': this.updatedGdpr
            }

            axios.put(`/api/gdpr/${this.gdprId}`, updatedRules )
            .then(response => {
                if(200 == response.status){
                    this.flashMessage.info({
                          title: `General Data Protection Regulation Rules updated successfully`,
                          icon: false,
                    })
                    this.gdpr = response.data.gdpr
                    this.id = response.data.id
                    this.gdprLoaded = true
                    this.editMode = false
                }
            })
            .catch(err=> {
                    const errors = err.response.data.errors.updatedRules[0];
                    this.editError = errors;
                    return
                })
        },

        onDeleteModal(){
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want delete General Data Protection Regulation?`, {
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
              this.deletePolicies(this.gdprId)
            }
          })
          .catch(err => {
            // An error occurred
          })
        },

        deletePolicies(id){
            this.loading = true;
            axios.delete(`/api/gdpr/${id}`)
            .then(response => {
                this.loading = false;
                this.gdpr = null;
                this.gdprLoaded = false;
                this.gdprId = null;
                this.flashMessage.error({
                    title: 'General Data Protection Regulation Rules successfully deleted'
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
