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
                        <label for="category_name">Rename category</label>
                            <input
                            type="text"
                            class="form-control"
                            v-model="editCategoryData.category_name"
                            name="category_name"
                            :placeholder="category.category_name"
                            :class="[{'is-invalid': errorFor('category_name')}]"
                            >
                            <v-errors :errors="errorFor('category_name')"></v-errors>
                    </div>
                            <button
                                @click="updateCategory()"
                                class="btn btn-lg btn-success"
                                >Update category</button>
                </div>
            </div>
            <hr>
            <div class="row justify-content-left m-5">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">Brands linked to "{{category.category_name}}" category</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Brand name</th>
                                  <th>Created</th>
                                  <th>Updated</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Brand name</th>
                                  <th>Created</th>
                                  <th>Updated</th>
                                  <th>Delete</th>
                                </tr>
                              </tfoot>
                                <tbody v-for="brand in category.brands" :key = brand.id >
                                    <tr>
                                      <td>{{brand.id}}</td>
                                      <td>{{brand.brand_name}}</td>
                                      <td>{{brand.created_at | fromNow}}</td>
                                      <td>{{brand.updated_at | fromNow}}</td>
                                      <td><b-button class="btn btn-danger" @click="showBrandConfirmationModal(brand)"><i class="fas fa-trash-alt"></i> Delete</b-button></td>
                              </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 align-middle">
                                <div class="form-group">
                                  <label for="select_brand">Add brand to "{{category.category_name}}" category</label>
                                     <select
                                        class="form-control"
                                        name="select_brand"
                                        v-model="selectedBrandId"
                                        :class="[{'is-invalid': errors}]">
                                       <option disabled value="">Select brand</option>
                                       <option v-for="(brand, index) in brands" :key="index" :value="brand.id">{{brand.brand_name}}</option>
                                     </select>
                                  <span style="color: red; font-size: 11px">{{errors}}</span>
                              </div>
                                  <button class="btn btn-lg btn-success" @click="attachBrandToCategory()">Add brand</button>



                </div>
            </div>
            <hr>
            <div class="m-5"><h2>Models linked to "{{category.category_name}}" category</h2></div>
            <div class="row justify-content-left m-5">
                <div class="col-md-4">
                  <div class="row">
                            <label for="select_brand">Select brand to display all linked models to this brand and linked to "{{category.category_name}}" category</label>
                                <div class="input-group">
                                     <select
                                        class="custom-select"
                                        id="inputGroupSelect04"
                                        name="select_brand"
                                        v-model="selectedBrandId"
                                        @change="getDistinctModels(); getModelsBelongingToCategoryAndSelectedBrand()">

                                       <option disabled value="">Select brand</option>
                                       <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{brand.brand_name}}</option>
                                     </select>

                            </div>
                  </div>
                  <div v-if="selectedBrandId" class="mt-5">
                    <div class="form-group">
                      <label for="select_model">Add model to model "{{category.category_name}}" category</label>
                         <select
                            class="form-control"
                            id="inputGroupSelect04"
                            name="select_model"
                            v-model="selectedModelId"
                            :class="[{'is-invalid': modelError}]">
                           <option disabled value="">Select model</option>
                           <option v-for="(model, index) in models" :key="index" :value="model.id">{{model.model_name}}</option>
                         </select>
                         <span style="color: red; font-size: 11px">{{modelError}}</span>
                    </div>
                      <button class="btn btn-lg btn-success" @click="attachModelToCategory()">Add model</button>
                    </div>
                </div>
                <div class="col-md-8" v-if="queriedModels">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">All models linked to "{{category.category_name}}" category</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Model name</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Model name</th>
                                  <th>Delete</th>
                                </tr>
                              </tfoot>
                                <tbody v-for="queriedModel in queriedModels" :key = queriedModel.id >
                                    <tr>
                                      <td>{{queriedModel.id}}</td>
                                      <td>{{queriedModel.model_name}}</td>
                                      <td><b-button class="btn btn-danger" @click="showModelConfirmationModal(queriedModel)"><i class="fas fa-trash-alt"></i> Delete</b-button></td>
                              </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {is404, is422, is500} from "./../../../shared/utils/response";
import validationErrors from "../../../shared/mixins/validationErrors";
export default {
    mixins:[validationErrors],
    data(){
        return{
            loading: false,
            category: {},
            brands: {},

            selectedBrandId: null,

            editCategoryData: {},

            selectedModelId: null,
            models: {},
            queriedModels:null,

            modelError: null,
            brandConfirmedDeletion: '',
            modelConfirmedDeletion: ''
        }
    },

    created(){
        this.loading = true;
        axios.get(`/api/kategorie/${this.$route.params.id}`)
        .then(response => {
            this.category = response.data
            this.loading = false;
        });
        axios.get('/api/znacky')
        .then(response => {
            this.brands = response.data
             this.loading = false
        });

    },

    methods:{
        updateCategory(){
            this.loading = true;
            this.errors = null;
            axios.put(`/api/kategorie/${this.category.id}`, this.editCategoryData)
                .then(response => {
                    this.loading = false
                    this.flashMessage.info({
                    title: `Category renamed successfully`,
                    icon: false,
                    message: `Category "${this.category.category_name}" has been renamed to "${this.editCategoryData.category_name}" category`
            });
                })
                .catch(err=> {
                    if(is422(err)){
                         const errors = err.response.data.errors;
                            if (errors["category_name"] && 1 === _.size(errors)) {
                                this.errors = errors;
                                return;
                            }
                    }
                })
                .then(() => this.loading = false)
        },

        attachBrandToCategory(){
            this.loading = true;
            this.errors = null;
            axios.get(`/api/kategorie/${this.category.id}/pridat-znacku/${this.selectedBrandId}`)
            .then(response => {
              const fetchedData = response.data;
              this.category.brands.push(fetchedData);
              this.flashMessage.info({
               title: `Brand successfully linked to category`,
               icon: false,
               message: `Brand "${fetchedData.brand_name}" has been linked to ${this.category.category_name} category`
            });
            })
            .catch(err=> {
                if(is500(err)){
                    this.errors = `Category ${this.category.category_name} already contains this brand`;
                    return;
                  }
            })
            .then(() => this.loading = false)
            },
        showBrandConfirmationModal(brand) {
        this.brandConfirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want to unlink "${brand.brand_name}" brand from  ${this.category.category_name} category?`,  {
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
            this.brandConfirmedDeletion = value
            if(this.brandConfirmedDeletion){
              this.unattachBrandFromCategory(brand)
            }
          })
      },

        unattachBrandFromCategory(brand){
            this.loading = true;
            axios.get(`/api/kategorie/${this.category.id}/odobrat-znacku/${brand.id}`)
            .then(response => {
                let index = this.category.brands.indexOf(brand);
                this.category.brands.splice(index,1);
                this.flashMessage.error({
                  title: `Brand successfully unlinked from this category`,
                  icon: false,
                  message: `Brand "${brand.brand_name}" unlinked from "${this.category.category_name}" category`
                  });
            }).then(() => this.loading = false)
        },

        getDistinctModels(){
          this.loading = true;
          axios.get(`/api/modely-nepatriace-kategorii/${this.category.id}/znacka/${this.selectedBrandId}`)
            .then(response => {
              this.models = response.data
            }). then(() => this.loading = false)
        },

        getModelsBelongingToCategoryAndSelectedBrand(){
          this.loading = true;
          axios.get(`/api/modely-podla-kategorie/${this.category.id}/znacky/${this.selectedBrandId}`)
            .then(response => {
              this.queriedModels = response.data
            }). then(() => this.loading = false)
        },

        attachModelToCategory(){
            this.loading = true;
            this.errors = null
            axios.get(`/api/kategorie/${this.category.id}/pridat-model/${this.selectedModelId}`)
            .then(response => {
              const fetchedData = response.data;
              this.queriedModels.push(fetchedData);
              this.flashMessage.info({
               title: `Model successfully linked to category`,
               icon: false,
               message: `Model "${fetchedData.model_name}" linked to ${this.category.category_name} category`
            });

            })
            .catch(err=> {
                if(is500(err)){
                    this.modelError = `Category ${this.category.category_name} already contains this model`;
                    return;
                  }
            })
            .then(() => this.loading = false)
            },
          showModelConfirmationModal(model) {
        this.modelConfirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want to unlink "${model.model_name}" model from ${this.category.category_name} category?`,  {
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
            this.modelConfirmedDeletion = value
            if(this.modelConfirmedDeletion){
              this.unattachModelFromCategory(model)
            }
          })
      },

         unattachModelFromCategory(model){
            this.loading = true;
            axios.get(`/api/kategorie/${this.category.id}/odobrat-model/${model.id}`)
            .then(response => {
                let index = this.queriedModels.indexOf(model);
                this.queriedModels.splice(index,1);
                this.flashMessage.error({
                  title: `Model successfully unlinked from this category`,
                  icon: false,
                  message: `Model${model.model_name}" has been successfully unlinked from "${this.category.category_name}" category`
                  });
            }).then(() => this.loading = false)
        },
    }
}
</script>
