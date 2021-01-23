<template>
    <div v-if="loading">
            <atom-spinner class="my-center"
              :animation-duration="1000"
              :size="80"
              :color="'#086972'"
            />
    </div>
   <div v-else class="row">
            <div class="col-md-12">
                <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Orders</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-hover">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>User ID</th>
                          <th>Payment method</th>
                          <th>Delivery method</th>
                          <th>Notes</th>
                          <th>Order status</th>
                          <th>Total price</th>
                          <th>Created at</th>
                          <th>Confirmed at</th>
                          <th>Display basket</th>
                          <th>Approve</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>User ID</th>
                          <th>Payment method</th>
                          <th>Delivery method</th>
                          <th>Notes</th>
                          <th>Order status</th>
                          <th>Total price</th>
                          <th>Created at</th>
                          <th>Confirmed at</th>
                          <th>Display basket</th>
                          <th>Approve</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="order in orders" :key = order.id >
                            <tr>
                                <td class="align-middle">{{order.id}}</td>
                                <!-- <td class="align-middle"><router-link :to="{name: 'view-user', params:{id: order.user_id}}">{{order.user_id}}</router-link></td> -->
                                <td class="align-middle"> <div class="link" v-b-modal.userModal  @click="getUserData(order.user_id)"><b>{{order.user_id}}</b></div></td>
                                <td class="align-middle">{{order.payment_method}}</td>
                                <td class="align-middle">{{order.delivery_method}}</td>
                                <td class="align-middle">{{order.orders_note}}</td>
                                <td class="align-middle">{{order.order_status}}</td>
                                <td class="align-middle">{{order.total_price}}</td>
                                <td class="align-middle">{{order.created_at}}</td>
                                <td class="align-middle">{{order.updated_at}}</td>
                                <td class="align-middle text-center"><button class="btn btn-primary btn-lg" v-b-modal.orderModal @click="getOrderItems(order.id)">Display</button></td>
                                <td class="align-middle text-center"><button class="btn btn-success btn-lg" @click="displayModal(order.id)" >Approve</button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>

        <b-modal id="userModal" button-size = "lg" title-html="<h2>User info</h2>"  ok-only>
            <div v-if="loadingModal" class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-if="user">
                <p class="my-4"><b>First name:&nbsp;</b>{{user.first_name}}</p>
                <p class="my-4"><b>Last name:&nbsp;</b>{{user.last_name}}</p>
                <p class="my-4"><b>Phone number:&nbsp;</b>{{user.phone_number}}</p>
                <p class="my-4"><b>Email:&nbsp;</b>{{user.email}}</p>
                <p class="my-4"><b>Street:&nbsp;</b>{{user.street}}</p>
                <p class="my-4"><b>County:&nbsp;</b>{{user.county}}</p>
                <p class="my-4"><b>Eircode:&nbsp;</b>{{user.zip}}</p>
            </div>
        </b-modal>

        <b-modal id="orderModal" size="lg" button-size = "lg" title-html="<h2>Order items</h2>"  ok-only>
            <div v-if="loadingModal" class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-if="orderItems">
                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product ID</th>
                    <th>Product title</th>
                    <th>Product Price</th>
                  </tr>
                </thead>
                    <tbody v-for="(item, index) in orderItems" :key="index">
                        <tr>
                            <td class="align-middle">{{index+1}}</td>
                            <td class="align-middle">{{item.product_id}}</td>
                            <td class="align-middle">{{item.product_title}}</td>
                            <td class="align-middle">€{{item.product_price}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </b-modal>
    </div>

</template>
<script>
export default {
    data() {
        return{
            orders: null,
            user:null,
            orderItems: null,

            loading: false,
            loadingModal: false,

            confirmedDeletion: null,
        }
    },

    created(){
        this.loading = true;
        axios.get(`/api/orders`)
        .then(response => {
            this.orders = response.data;
            this.loading = false;
        })
    },

    methods:{
        getUserData(userId){
            this.loadingModal = true;
            this.user = null;
            axios.get(`/api/user/${userId}`)
            .then(response => {
                this.user = response.data;
                console.log(this.user);

                this.loadingModal = false
            })
        },

        getOrderItems(orderId){
            this.loadingModal = true;
            this.orderItems = null;
            axios.get(`/api/getOrderItems/${orderId}`)
            .then(response => {
                this.orderItems = response.data;
                console.log(this.orderItems);
                this.loadingModal = false;
            })
        },

        displayModal(orderId){
          this.confirmedDeletion = ''
          this.$bvModal.msgBoxConfirm(`Do you really want approve this order and email the customer?`, {
          title: 'Please confirm',
          size: 'md',
          buttonSize: 'lg',
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
              this.confirmOrder(orderId)
            }
          })
          .catch(err => {
            // An error occurred
          })
        },

        confirmOrder(orderID){
            axios.get(`/api/confirmOrder/${orderID}`)
            .then(response => {
                if(response.data.status == 'success'){
                    this.flashMessage.info({
                        title: `Order successfully confirmed`,
                        icon: false,
                        message: 'Customer has been emailed. '
                     });
                }

            })
        }


    }


}
</script>

