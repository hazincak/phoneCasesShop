<template>
 <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
  </div>
  <div v-else>
      <div class="container-fluid">
    <div class="row">
        <div class="col">
          <form class="form-inline ml-auto">
                <div class="form-group ">
                    <label for="productQuantity" class="mr-2">Display: </label>
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
                <div class="form-group ml-auto">
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
                            <option value= 'id' selected disabled>Sort products</option>
                          <option value="price">Sort by price</option>
                          <option value="created_at">Sort by date</option>
                        </select>
                </div>
            </form>

         <div class="card shadow mb-4 mt-2">

           <div>
            <b-modal id="modal-updateProduct" size="xl" title="Upraviť produkt"
              :hide-footer = true>
            </b-modal>
            <b-modal id="modal-addProduct" size="xl" title-html="<h3>Add product</h3"

            :hide-footer = true>
              <add-product></add-product>
            </b-modal>
          </div>
                <div class="card-header d-flex">
                  <h3 class="m-0 font-weight-bold text-secondary">Products</h3> <b-button class="ml-auto" v-b-modal.modal-addProduct variant="primary"><span class="fa fa-plus"></span> Add Product</b-button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="users-table"  cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Main image</th>
                          <th>Short description</th>
                          <th>Detailed description</th>
                          <th>Model</th>
                          <th>Brand</th>
                          <th>Price</th>
                          <th>Colour</th>
                          <th>Material</th>
                          <th>Created</th>
                          <th>Updated</th>
                          <th>Add to Carousel</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Main image</th>
                          <th>Short description</th>
                          <th>Detailed description</th>
                          <th>Model</th>
                          <th>Brand</th>
                          <th>Price</th>
                          <th>Colour</th>
                          <th>Material</th>
                          <th>Created</th>
                          <th>Updated</th>
                          <th>Add to Carousel</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="product in products.data" :key="product.id">
                          <tr>
                            <td class="align-middle">{{product.id}}</td>
                            <td class="align-middle"><router-link :to="{name: 'updateProduct', params:{id: product.id}}">{{product.title}}</router-link></td>
                            <td class="align-middle">{{product.category.category_name}}</td>
                            <td class="align-middle"><img class="table-img" :src='product.images[0].path'></td>
                            <td>{{product.description_short}}</td>
                            <td>{{product.description_long | shortened}} </td>
                            <td class="align-middle">{{product.brand.brand_name}}</td>
                            <td class="align-middle">{{product.model.model_name}}</td>
                            <td class="align-middle">{{product.price}}</td>
                            <td class="align-middle">{{product.color.color}}</td>
                            <td class="align-middle">{{product.material.material}}</td>
                            <td class="align-middle text-center">{{product.created_at | fromNow}}</td>
                            <td class="align-middle text-center">{{product.updated_at | fromNow}}</td>
                            <td class="align-middle">
                                 <b-button class="btn btn-success" @click="addProductToCarousel(product.id)"><i class="fas fa-plus"></i>&nbsp;Add to Carousel</b-button>
                            </td>
                            <td class="align-middle">
                                <b-button class="btn btn-danger mb-1" @click="showConfirmationModal(product)"><i class="fas fa-trash-alt"></i>&nbsp;Delete product</b-button>
                            </td>
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
                axios.get(`/api/all-products?page=${page}&perPage=${this.perPage}&orderBy=${this.orderBy}&order=${this.order}`)
                .then(response => {
                    this.products = response.data;
                    this.loading=false;
                });
        },


    deleteProduct(product){
      this.loading = true;
        axios.delete(`/api/product/${product.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.products.data.indexOf(product);
                this.products.data.splice(index,1);
                this.flashMessage.error({
                  title: 'Product successfully deleted',

                  message: `Product "${product.title}" has been deleted`
                  });
            });
    },

    showConfirmationModal(product) {
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Do you really want to delete "${product.title}" product?`, {
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
              this.deleteProduct(product)
            }
          })
          .catch(err => {
            // An error occurred
          })
      },


    addProductToCarousel(productId){
       let carouselObject = {
           'productId' : productId
       }
       axios.post(`/api/carousel-items`, carouselObject)
       .then(response => {
          if(200 == response.status){
               this.flashMessage.info({
               title: `Product added to carousel`,
               icon: false,
            });
          }
       })
       .catch( error => {
           console.log(error);
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
