<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="m-5"> Manage Carousel</h1>
                <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Carousel items</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-hover">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Product title</th>
                          <th>Product short description</th>
                          <th>Product carousel image</th>
                          <th>Product price</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Product title</th>
                          <th>Product short description</th>
                          <th>Product carousel image</th>
                          <th>Product price</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="item in carouselItems" :key = item.id >
                            <tr>
                                <td class="align-middle">{{item.title}}</td>
                                <td class="align-middle">{{item.description_short}}</td>
                                <td class="align-middle text-center"><img style="width: 12rem" :src="item.image.path"></td>
                                <td class="align-middle">{{item.price}}</td>
                                <td class="align-middle"><b-button class="btn btn-danger" @click="showConfirmationModal(item)"><i class="fas fa-trash-alt"></i> Delete</b-button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            carouselItems: null,
            confirmedDeletion: ''
        }
    },

    created(){
        axios.get(`/api/carousel-items`)
        .then(response => {
            this.carouselItems = response.data
        })
    },

    methods: {
        showConfirmationModal(carouselItem){
            this.confirmedDeletion = ''
            this.$bvModal.msgBoxConfirm(`Do you really want to delete this product from the home page carousel?`, {
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
                this.deleteProductFromCarousel(carouselItem);
            }
        })
        },

        deleteProductFromCarousel(carouselItem){
            axios.delete(`/api/carousel-items/${carouselItem.id}`)
            .then(response => {
                if(200 == response.status){
                    let index = this.carouselItems.indexOf(carouselItem);
                    this.carouselItems.splice(index,1);
                    this.flashMessage.error({
                        title: 'Carousel item successfully deleted',
                    })
                }
            })
        }
    }
}
</script>
