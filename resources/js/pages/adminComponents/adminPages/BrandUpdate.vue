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
                                @click="updateBrand()"
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
                        <div class="card-body">
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
                                      <td><button class="btn btn-danger" @click="deleteModel(model)" ><i class="fas fa-trash-alt"></i> Odstrániť</button></td>
                              </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    
                            <label for="select_brand">Pridať model a priradiť ku značke "{{brand.brand_name}}"</label>
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
                                    >Pridať a priradiť model</button>
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
            }
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
                    title: `Značka úspěšné premenovaná`,
                    icon: false,
                    message: `Značka s názvom "${this.brand.brand_name}" bola premenovaná na značku s názvom "${this.editBrandData.brand_name}"`
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
                  title: 'Model úspěšné vytvorený',
                  icon: false,
                  message: `Model s názvom "${this.model.model_name}" vytvorený a priradený ku značke ${this.brand.brand_name}`
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

        deleteModel(model){
            this.loading = true;
            axios.delete(`/api/model/${model.id}`)
                .then(response => {
                    let index = this.brand.device_models.indexOf(model);
                    this.brand.device_models.splice(index, 1);
                    this.flashMessage.error({
                  title: 'Model úspěšné vymazaný',
                  icon: false,
                  message: `Model s názvom "${model.model_name}" vymazaný`
                  });
                })
                .then(() => this.loading = false)
        }



        

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