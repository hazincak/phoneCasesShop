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
            <div class="m-5"><h2>Správa kategorií</h2></div>
            <div class="row justify-content-left m-5">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="category_name">Premenovat názov kategórie</label>
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
                                >Aktualizovať kategóriu</button>
                </div>
            </div>
            <hr>
            <div class="row justify-content-left m-5">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">Značky priradené ku kategorií "{{category.category_name}}"</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Názov značky</th>
                                  <th>Vytvorené</th>
                                  <th>Aktualizované</th>
                                  <th>Odstrániť</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Názov značky</th>
                                  <th>Vytvorené</th>
                                  <th>Aktualizované</th>
                                  <th>Odstrániť</th>
                                </tr>
                              </tfoot>
                                <tbody v-for="brand in category.brands" :key = brand.id >
                                    <tr>
                                      <td>{{brand.id}}</td>
                                      <td>{{brand.brand_name}}</td>
                                      <td>{{brand.created_at | fromNow}}</td>
                                      <td>{{brand.updated_at | fromNow}}</td>
                                      <td><button class="btn btn-danger" @click="unattachBrandFromCategory(brand)"><i class="fas fa-trash-alt"></i> Odstrániť</button></td>
                              </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 align-middle">
                    
                            <label for="select_brand">Pridat značku ku kategorií "{{category.category_name}}"</label>
                                <div class="input-group">
                                     <select 
                                        class="custom-select" 
                                        id="inputGroupSelect04" 
                                        name="select_brand"
                                        v-model="selectedBrandId">
                                       <option disabled value="">Vyberte značku</option>
                                       <option v-for="(brand, index) in brands" :key="index" :value="brand.id">{{brand.brand_name}}</option>
                                     </select>
                                <div class="input-group-append">
                                  <button class="btn btn-lg btn-success" @click="attachBrandToCategory()">Pridat značku</button>
                                </div>
                            </div>
                </div>
            </div>
            <hr>
            <div class="m-5"><h2>Správa modelov priradených ku kategorií "{{category.category_name}}"</h2></div>
            <div class="row justify-content-left m-5">
                <div class="col-md-4">
                  <div class="row">
                            <label for="select_brand">Vyberte značku pre zobrazenie vsetkych jej modelov priradenych ku kategorií "{{category.category_name}}"</label>
                                <div class="input-group">
                                     <select 
                                        class="custom-select" 
                                        id="inputGroupSelect04" 
                                        name="select_brand"
                                        v-model="selectedBrandId"
                                        @change="getDistinctModels(); getModelsBelongingToCategoryAndSelectedBrand()">
                                        
                                       <option disabled value="">Vyberte značku</option>
                                       <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{brand.brand_name}}</option>
                                     </select>
        
                            </div>
                  </div>
                  <div v-if="selectedBrandId" class="row mt-5">
                    
                            <label for="select_model">Pridat model ku kategorií "{{category.category_name}}"</label>
                                <div class="input-group">
                                     <select 
                                        class="custom-select" 
                                        id="inputGroupSelect04" 
                                        name="select_model"
                                        v-model="selectedModelId">
                                       <option disabled value="">Vyberte model</option>
                                       <option v-for="(model, index) in models" :key="index" :value="model.id">{{model.model_name}}</option>
                                     </select>
                                <div class="input-group-append">
                                  <button class="btn btn-lg btn-success" @click="attachModelToCategory()">Pridat model</button>
                                </div>
                            </div>
                  </div>
                </div>
                <div class="col-md-8" v-if="queriedModels">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">Modely značky ku kategorií "{{category.category_name}}"</h3>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Názov modelu</th>
                                  <th>Odstrániť</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Názov modelu</th>
                                  <th>Odstrániť</th>
                                </tr>
                              </tfoot>
                                <tbody v-for="queriedModel in queriedModels" :key = queriedModel.id >
                                    <tr>
                                      <td>{{queriedModel.id}}</td>
                                      <td>{{queriedModel.model_name}}</td>
                                      <td><button class="btn btn-danger" @click="unattachModelFromCategory(queriedModel)"><i class="fas fa-trash-alt"></i> Odstrániť</button></td>
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
import {is404, is422} from "./../../../shared/utils/response";
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
                    title: `Kategória úspěšné premenovaná`,
                    icon: false,
                    message: `Kategória s názvom "${this.category.category_name}" bola premenovaná na kategóriu s názvom "${this.editCategoryData.category_name}"`
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
            axios.get(`/api/kategorie/${this.category.id}/pridat-znacku/${this.selectedBrandId}`)
            .then(response => {
              const fetchedData = response.data;
              this.category.brands.push(fetchedData);  
              this.flashMessage.info({
               title: `Značka úspěšné pridaná ku kategorii`,
               icon: false,
               message: `Značka s názvom "${fetchedData.brand_name}" pridaná ku kategorii ${this.category.category_name} `
            });
            }).then(() => this.loading = false)
            },

        unattachBrandFromCategory(brand){
            this.loading = true;
            axios.get(`/api/kategorie/${this.category.id}/odobrat-znacku/${brand.id}`)
            .then(response => {
                let index = this.category.brands.indexOf(brand);
                this.category.brands.splice(index,1);
                this.flashMessage.error({
                  title: `Značka úspěšné odobrata z tejto kategorie`,
                  icon: false,
                  message: `Značka s názvom "${brand.brand_name}" odobrata z kategorie "${this.category.category_name}"`
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
            axios.get(`/api/kategorie/${this.category.id}/pridat-model/${this.selectedModelId}`)
            .then(response => {
              const fetchedData = response.data;
              this.queriedModels.push(fetchedData);  
              this.flashMessage.info({
               title: `Model úspěšné pridaný ku kategorii`,
               icon: false,
               message: `Model s názvom "${fetchedData.model_name}" pridaný ku kategorii ${this.category.category_name} `
            });
            }).then(() => this.loading = false)
            },

         unattachModelFromCategory(model){
            this.loading = true;
            axios.get(`/api/kategorie/${this.category.id}/odobrat-model/${model.id}`)
            .then(response => {
                let index = this.queriedModels.indexOf(model);
                this.queriedModels.splice(index,1);
                this.flashMessage.error({
                  title: `Model úspěšné odobratý z tejto kategorie`,
                  icon: false,
                  message: `Model s názvom "${model.model_name}" odobratý z kategorie "${this.category.category_name}"`
                  });
            }).then(() => this.loading = false)
        },
    }
}
</script>