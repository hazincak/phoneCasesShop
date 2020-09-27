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
         <div class="card shadow mb-4 mt-5">
           <div>   
            <b-modal id="modal-xl" size="xl" title="Pridať produkt">
              <add-product></add-product>
            </b-modal>
          </div>
                <div class="card-header d-flex">
                  <h3 class="m-0 font-weight-bold text-secondary">Produkty</h3> <b-button class="ml-auto" v-b-modal.modal-xl variant="primary"><span class="fa fa-plus"></span> Pridať produkt</b-button>
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
                          <th>Model</th>
                          <th>Značka</th>
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
                            <td class="align-middle">{{product.title}}</td>
                            <td class="align-middle">{{product.category}}</td>
                            <td class="align-middle"><img class="table-img" :src='product.images[0].path'></td>
                            <td>{{product.description_short}}</td>
                            <td>{{product.description_long}}</td>
                            <td class="align-middle">{{product.model}}</td>
                            <td class="align-middle">{{product.brand}}</td>
                            <td class="align-middle">{{product.price}}</td>
                            <td class="align-middle">{{product.color}}</td>
                            <td class="align-middle">{{product.material}}</td>
                            <td class="align-middle">{{product.created_at | fromNow}}</td>
                            <td class="align-middle">{{product.updated_at | fromNow}}</td>
                            <td class="align-middle"><button class="btn btn-danger" @click="deleteProduct(product)"><i class="fas fa-trash-alt"></i> Odstrániť</button></td>
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
    }
  },

  created(){
    this.getResults();
    },
  
  methods:{
    getResults(page = 1){
             this.loading = true
                axios.get(`/api/produkt?page=${page}`)
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
    }
  }
}
</script>

<style  scoped>
.table-img{
  width: 12rem;
}
</style>