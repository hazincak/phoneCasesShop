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
        <div class="col-md-8">
         <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Product categories</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-hover">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Category name</th>
                          <th>Created</th>
                          <th>Updated</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Category name</th>
                          <th>Created</th>
                          <th>Updated</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="item in categories" :key = item.id >
                            <tr>
                              <td>{{item.id}}</td>
                              <td><router-link :to="{name:'categoryUpdate', params: {id: item.id}}">{{item.category_name}}</router-link></td>
                              <td>{{item.created_at | fromNow}}</td>
                              <td>{{item.updated_at | fromNow}}</td>
                              <td class="align-middle"><b-button class="btn btn-danger" @click="showConfirmationModal(item)"><i class="fas fa-trash-alt"></i> Delete</b-button></td>
                      </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="category_name">Add category</label>
                    <input
                    type="text"
                    class="form-control"
                    v-model="category.category_name"
                    name="category_name"
                    placeholder="New category name"
                    :class="[{'is-invalid': errorFor('category_name')}]"
                    >
                    <v-errors :errors="errorFor('category_name')"></v-errors>
            </div>

                  <button
                     @click="addCategory"
                     class="btn btn-lg btn-success"
                     >Add category</button>
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
            categories: {},
            category:{
                category_name:null
            },
            confirmedDeletion: ''
        }
    },

    created(){
        this.loading = true;
        axios.get('/api/kategorie')
            .then(response =>{
                this.categories = response.data
                this.loading = false;
            });
    },

    methods:{

      showConfirmationModal(item) {
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(
          `Do you really want to delete "${item.category_name}" category? All brands, models and products linked to "${item.category_name}"category won't be accessible in the shop ! `, {
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
            this.confirmedDeletion = value
            if(this.confirmedDeletion){
              this.deleteCategory(item)
            }
          })
          .catch(err => {
            // An error occurred
          })
      },

      deleteCategory(item){
        this.loading = true;
        axios.delete(`/api/kategorie/${item.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.categories.indexOf(item);
                this.categories.splice(index,1);
                this.flashMessage.error({
                  title: 'Category successfully deleted',
                  icon: false,
                  message: `Category "${item.category_name}" has been deleted .`
                  });
            });
      },
     async addCategory(){
        this.loading = true;
        this.errors = null;


        await axios.post('/api/kategorie', this.category)
          .then(response=>{
            const fetchedData = response.data;
            this.categories.push(fetchedData);
            this.flashMessage.info({
               title: `Category successfully created`,
               icon: false,
               message: `Category "${fetchedData.category_name}" has been created`
            });
          })
          .catch(err =>{
            if(is422(err)){
              const errors = err.response.data.errors;
              if (errors["category_name"] && 1 === _.size(errors)) {
              this.errors = errors;
              return;
            }
            }

          })
          .then(() => this.loading = false)
      }
    }
}
</script>
