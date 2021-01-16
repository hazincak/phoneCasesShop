<template>
    <div>
        <div v-if="loading">
                <atom-spinner class="my-center"
                :animation-duration="1000"
                :size="80"
                :color="'#086972'"
            />
        </div>
        <div v-else>
            <div class="row justify-content-left m-5">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="brand_name">Rename brand name</label>
                            <input
                            type="text"
                            class="form-control"
                            v-model="editBrandData.brand_name"
                            name="brand_name"
                            :placeholder="brand.brand_name"
                            :class="[{'is-invalid': errorFor('brand_name')}]"
                            >
                            <v-errors :errors="errorFor('brand_name')"></v-errors>
                    </div>
                            <button
                                @click="updateBrand()"
                                class="btn btn-lg btn-success"
                                >Update brand</button>
                </div>
            </div>
            <hr>
            <div class="row justify-content-left m-5">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">Models linked to "{{brand.brand_name}}" brand</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Model name</th>
                                  <th>Created</th>
                                  <th>Updated</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Model name</th>
                                  <th>Created</th>
                                  <th>Updated</th>
                                  <th>Delete</th>
                                </tr>
                              </tfoot>
                                <tbody v-for="model in brand.device_models" :key = model.id >
                                    <tr>
                                      <td>{{model.id}}</td>
                                      <td>{{model.model_name}}</td>
                                      <td>{{model.created_at | fromNow}}</td>
                                      <td>{{model.updated_at | fromNow}}</td>
                                      <td><b-button class="btn btn-danger" @click="showConfirmationModal(model)"><i class="fas fa-trash-alt"></i> Odstrániť</b-button></td>
                              </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                            <label for="select_brand">Add model and link to "{{brand.brand_name}}" brand</label>
                                <div class="form-group">
                                    <input
                                    type="text"
                                    class="form-control"
                                    v-model="model.model_name"
                                    name="model_name"
                                    placeholder="Názov modelu"
                                    :class="[{'is-invalid': errorFor('model_name')}]"
                                    >
                                    <v-errors :errors="errorFor('model_name')"></v-errors>
                                </div>
                                <button
                                    @click="addModelAndAttachToBrand()"
                                    class="btn btn-lg btn-success"
                                    >Add and link this model</button>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
import {is404, is422} from "./../../../shared/utils/response";
import validationErrors from "../../../shared/mixins/validationErrors";
export default {
    mixins:[validationErrors],
    data(){
        return{
            loading: false,
            brand: {},
            models: {},
            selectedModelId: null,
            editBrandData: {},
            model:{
                model_name:null,
                brand_id:null
            },
            confirmedDeletion: ''
        }
    },

    created(){
        this.loading = true;
        axios.get(`/api/znacky/${this.$route.params.id}`)
        .then(response => {
            this.brand = response.data
            this.loading = false;
        });
    },

    methods:{
        updateBrand(){
            this.loading = true;
            this.errors = null;
            axios.put(`/api/znacky/${this.brand.id}`, this.editBrandData)
                .then(response => {
                    this.loading = false
                    this.flashMessage.info({
                    title: `Brand renamed successfully`,
                    icon: false,
                    message: `Brand "${this.brand.brand_name}" has been renamed to "${this.editBrandData.brand_name}"`
            });
                })
                .catch(err=> {
                    if(is422(err)){
                         const errors = err.response.data.errors;
                            if (errors["brand_name"] && 1 === _.size(errors)) {
                                this.errors = errors;
                                return;
                            }
                    }
                })
                .then(() => this.loading = false)
        },

        addModelAndAttachToBrand(){
            this.loading = true;
            this.model.brand_id = this.brand.id
            axios.post(`/api/model`, this.model)
            .then(response => {
                const fetchedData = response.data;
                this.brand.device_models.push(fetchedData);
                this.flashMessage.info({
                  title: 'Model successfully created',
                  icon: false,
                  message: `Model "${this.model.model_name}" created and linked to ${this.brand.brand_name} brand`
                  });
            }).catch(err=>{
                if(is422(err)){
                    const errors = err.response.data.errors;
                    if(errors['model_name'] && 1 === _.size(errors)){
                        this.errors = errors;
                        return;
                    }
                }
            })
            .then(() => this.loading = false)
        },

        showConfirmationModal(model) {
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want to delete "${model.model_name}" model?`,  {
          title: 'Please, confirm',
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
              this.deleteModel(model)
            }
          })
      },

        deleteModel(model){
            this.loading = true;
            axios.delete(`/api/model/${model.id}`)
                .then(response => {
                    let index = this.brand.device_models.indexOf(model);
                    this.brand.device_models.splice(index, 1);
                    this.flashMessage.error({
                  title: 'Model successfully deleted',
                  icon: false,
                  message: `Model "${model.model_name}" has been deleted`
                  });
                })
                .then(() => this.loading = false)
        }
    }
}
</script>
