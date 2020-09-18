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
            <div class="mt-5"><h3>Správa kategorií</h3></div>
            <div class="row justify-content-left mt-5">
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
            <div class="row justify-content-left mt-5 ml-2">
                <div class="col md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h3 class="m-0 font-weight-bold text-secondary">Značky priradené ku kategorií "{{category.category_name}}"</h3>
                        </div>
                        <div class="card-body mt-5">
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
                <div class="col md-6">
                    
                            <label for="select_brand">Pridat značku ku kategorií "{{category.category_name}}"</label>
                                <div class="input-group">
                                     <select 
                                        class="custom-select" 
                                        id="inputGroupSelect04" 
                                        name="select_brand"
                                        v-model="selectedBrand">
                                       <option disabled value="">Vyberte značku</option>
                                       <option v-for="(brand, index) in brands" :key="index">{{brand.brand_name}}</option>
                                     </select>
                                <div class="input-group-append">
                                  <button class="btn btn-lg btn-success" @click="attachBrandToCategory()">Pridat značku</button>
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
            selectedBrand : '',
            editCategoryData: {
                
            },

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

        unattachBrandFromCategory(){

        },

        attachBrandToCategory(){

        }
    }
}
</script>