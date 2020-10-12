<template>
 <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
  </div>
  <div v-else>
    <div class="row">
        <div class="col-12">
          <form class="form-inline ml-auto p-3">
                                
                                    <div class="form-group mr-5">
                                        <label for="productQuantity" class="mr-2">Počet zobrazených: </label>
                                            <select 
                                            class="form-control"
                                            name="productsQuantity"
                                            v-model="perPage"
                                            >
                                              <option value = 8>8</option>
                                              <option value = 12>12</option>
                                              <option value = 16>16</option>
                                              <option value = 32>32</option>
                                              
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <div v-if="orderBy != 'id'">
                                            <div v-if="order == 'asc'">
                                                <i @click="order = 'desc'"  class="fas fa-sort-amount-down-alt mr-2 orderBy-icon"></i>
                                            </div>
                                            <div v-if="order == 'desc'">
                                                <i @click="order = 'asc'" class="fas fa-sort-amount-down mr-2 orderBy-icon"></i>
                                            </div>
                                        </div>
                                        
                                            <select 
                                                class="form-control"
                                                v-model="orderBy"
                                                >
                                                <option value= 'id' selected disabled>Zoradiť produkty</option>
                                              <option value="price">Zoradiť podľa ceny</option>
                                              <option value="created_at">Zoradiť podľa dátumu pridania</option>
                                            </select>
                                    </div>
                                
                            </form>
          
         <div class="card shadow mb-4 mt-2">
           
           <div>   
            <b-modal id="modal-updateProduct" size="xl" title="Upraviť produkt"
              :hide-footer = true>
            </b-modal>
            <b-modal id="modal-addProduct" size="xl" title="Pridať produkt"
           
            :hide-footer = true>
              <add-product></add-product>
            </b-modal>
          </div>
                <div class="card-header d-flex">
                  <h3 class="m-0 font-weight-bold text-secondary">Produkty</h3> <b-button class="ml-auto" v-b-modal.modal-addProduct variant="primary"><span class="fa fa-plus"></span> Pridať produkt</b-button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Titul</th>
                          <th>Kategória</th>
                          <th>Hlavný obrázok</th>
                          <th>Krátky popis</th>
                          <th>Dlhý popis</th>
                          <th>Model</th>
                          <th>Značka</th>
                          <th>Cena</th>
                          <th>Farba</th>
                          <th>Materiál</th>
                          <th>Vytvorené</th>
                          <th>Aktualizované</th>
                          <th>Odstrániť</th> 
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Titul</th>
                          <th>Kategória</th>
                          <th>Hlavný obrázok</th>
                          <th>Krátky popis</th>
                          <th>Dlhý popis</th>
                          <th>Značka</th>
                          <th>Model</th>
                          <th>Cena</th>
                          <th>Farba</th>
                          <th>Materiál</th>
                          <th>Vytvorené</th>
                          <th>Aktualizované</th>
                          <th>Odstrániť</th> 
                        </tr>
                      </tfoot>
                        <tbody v-for="product in products.data" :key="product.id">
                          <tr>
                            <td class="align-middle">{{product.id}}</td>
                            <td class="align-middle"><router-link :to="{name: 'updateProduct', params:{id: product.id}}">{{product.title}}</router-link></td>
                            <td class="align-middle">{{product.category.category_name}}</td>
                            <td class="align-middle"><img class="table-img" :src='product.images[0].path'></td>
                            <td>{{product.description_short}}</td>
                            <td>{{product.description_long}}</td>
                            <td class="align-middle">{{product.brand.brand_name}}</td>
                            <td class="align-middle">{{product.model.model_name}}</td>
                            <td class="align-middle">{{product.price}}</td>
                            <td class="align-middle">{{product.color.color}}</td>
                            <td class="align-middle">{{product.material.material}}</td>
                            <td class="align-middle text-center">{{product.created_at | fromNow}}</td>
                            <td class="align-middle text-center">{{product.updated_at | fromNow}}</td>
                            <td class="align-middle"><b-button class="btn btn-danger" @click="showConfirmationModal(product)"><i class="fas fa-trash-alt"></i> Odstrániť</b-button></td>
                          </tr>
                        </tbody>
                        
                    </table>
                    <pagination :data="products" align='center' @pagination-change-page="getResults">
 
                        </pagination>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import AddProduct from './AddProduct';
export default {
  components:{
        AddProduct
    },
  data(){
    return{
      loading:false,
      products: {},
      perPage: 16,
      orderBy: 'id',
      order: 'asc',
      confirmedDeletion: ''
    }
  },

  created(){
    this.getResults();
    },

   watch:{
        perPage: function(){
            this.getResults() 
        },
        orderBy: function(){
            this.getResults()
        },
        order: function(){
            this.getResults()
        }
    },
  
  methods:{
    getResults(page = 1){
             this.loading = true
                axios.get(`/api/produkt?page=${page}&perPage=${this.perPage}&orderBy=${this.orderBy}&order=${this.order}`)
                .then(response => {
                    this.products = response.data;
                    this.loading=false;
                });
        },


    deleteProduct(product){
      this.loading = true;
        axios.delete(`/api/produkt/${product.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.products.data.indexOf(product);
                this.products.data.splice(index,1);
                this.flashMessage.error({
                  title: 'Produkt úspěšné vymazaný',
                 
                  message: `Produkt s názvom "${product.title}" vymazaný`
                  });
            });
    },

    showConfirmationModal(product) {
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Naozaj chcete odstrániť produkt s názvom "${product.title}" ?`, {
          title: 'Prosím, potvrďte',
          size: 'md',
          buttonSize: 'md',
          okVariant: 'danger',
          okTitle: 'Áno',
          cancelTitle: 'Nie',
          footerClass: 'p-2',
          hideHeaderClose: false,
          centered: true
        })
          .then(value => {
            this.confirmedDeletion = value
            if(this.confirmedDeletion){
              this.deleteProduct(product)
            }
          })
          .catch(err => {
            // An error occurred
          })
      }
  }
}
</script>

<style  scoped>
.table-img{
  width: 12rem;
}
</style>