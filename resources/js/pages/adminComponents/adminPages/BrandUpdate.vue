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
            <div class="m-5"><h3>Správca značiek</h3></div>
            <div class="row justify-content-left m-5">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="brand_name">Premenovat názov značky</label>
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
                                @click="updatebrand()"
                                class="btn btn-lg btn-success" 
                                >Aktualizovať značku</button>
                </div>
            </div>
            <hr>
            <div class="row justify-content-left m-5">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">Modely priradené ku značke "{{brand.brand_name}}"</h3>
                        </div>
                        <div class="card-body mt-5">
                          <div class="table-responsive table-hover">
                            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Názov modelu</th>
                                  <th>Vytvorené</th>
                                  <th>Aktualizované</th>
                                  <th>Odstrániť</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Id</th>
                                  <th>Názov modelu</th>
                                  <th>Vytvorené</th>
                                  <th>Aktualizované</th>
                                  <th>Odstrániť</th>
                                </tr>
                              </tfoot>
                                <tbody v-for="model in brand.device_models" :key = model.id >
                                    <tr>
                                      <td>{{model.id}}</td>
                                      <td>{{model.model_name}}</td>
                                      <td>{{model.created_at | fromNow}}</td>
                                      <td>{{model.updated_at | fromNow}}</td>
                                      <td><button class="btn btn-danger" ><i class="fas fa-trash-alt"></i> Odstrániť</button></td>
                              </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    
                            <label for="select_brand">Pridat model ku značke "{{brand.brand_name}}"</label>
                                <div class="input-group">
                                     <select 
                                        class="custom-select" 
                                        id="inputGroupSelect04" 
                                        name="select_brand"
                                        v-model="selectedModelId">
                                       <option disabled value="">Vyberte model</option>
                                       <option v-for="(brand, index) in brands" :key="index" :value="brand.id">{{brand.brand_name}}</option>
                                     </select>
                                <div class="input-group-append">
                                  <button class="btn btn-lg btn-success" >Pridat model</button>
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
            brand: {},
            models: {},
            selectedModelId: null,
            editBrandData: {},

        }
    },

    created(){
        this.loading = true;
        axios.get(`/api/znacky/${this.$route.params.id}`)
        .then(response => {
            this.brand = response.data
            this.loading = false;
        });
        // axios.get('/api/znacky')
        // .then(response => {
        //     this.brands = response.data
        //      this.loading = false
        // });

    },

    methods:{
        updateBrand(){
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



        

        // attachBrandToCategory(){
        //     this.loading = true;
        //     axios.get(`/api/kategorie/${this.category.id}/pridat-znacku/${this.selectedBrandId}`)
        //     .then(response => {
        //       const fetchedData = response.data;
        //       this.category.brands.push(fetchedData);  
        //       this.flashMessage.info({
        //        title: `Značka úspěšné pridaná ku kategorii`,
        //        icon: false,
        //        message: `Značka s názvom "${fetchedData.brand_name}" pridaná ku kategorii ${this.category.category_name} `
        //     });
        //     }).then(() => this.loading = false)
        //     },

        // unattachBrandFromCategory(brand){
        //     this.loading = true;
        //     axios.get(`/api/kategorie/${this.category.id}/odobrat-znacku/${brand.id}`)
        //     .then(response => {
        //         let index = this.category.brands.indexOf(brand);
        //         this.category.brands.splice(index,1);
        //         this.flashMessage.error({
        //           title: `Značka úspěšné odobrata z tejto kategorie`,
        //           icon: false,
        //           message: `Značka s názvom "${brand.brand_name}" odobrata z kategorie "${this.category.category_name}"`
        //           });
        //     }).then(() => this.loading = false)
        // },
    }
}
</script>