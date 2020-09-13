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
         <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Kategórie produktov</h6>
                </div>
                <div class="card-body mt-5">
                  <div class="table-responsive table-hover">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Názov kategórie</th>
                          <th>Vytvorená</th>
                          <th>Aktualizovaná</th>
                          <th>Odstrániť</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Názov kategórie</th>
                          <th>Vytvorená</th>
                          <th>Aktualizovaná</th>
                          <th>Odstrániť</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="item in categories" :key = item.id >
                            <tr>
                        <td>{{item.id}}</td>
                        <td><router-link :to="{name:'updateCategory', params: {id: item.id}}">{{item.category_name}}</router-link></td>
                        <td>{{item.created_at | fromNow}}</td>
                        <td>{{item.updated_at | fromNow}}</td>
                          <td><button class="btn btn-danger" @click="deleteCategory(item)">Odstrániť</button></td>
                      </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group mt-5">
                <label for="category_name">Pridať kategoriu</label>
                <input 
                type="text" 
                class="form-control" 
                v-model="category.category_name"
                name="category_name"
                placeholder="Pomenujte novu kategoriu"
                :class="[{'is-invalid': errorFor('category_name')}]"
                 >
                 <v-errors :errors="errorFor('category_name')"></v-errors>
            </div>
            <button 
            @click="addCategory"
            class="btn btn-lg btn-primary btn-block" 
            >Pridať kategoriu</button>
        </div>
        
</div>
</div>
</template>

<script>
import validationErrors from "../../../shared/mixins/validationErrors";
export default {
  mixins:[validationErrors],
    data(){
        return{
            loading: false,
            
            categories: {},
            category:{
                category_name:null
            }
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
      deleteCategory(item){
        this.loading = true;
        axios.delete(`/api/kategorie/${item.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.categories.indexOf(item);
                this.categories.splice(index,1);
            });
      },
      addCategory(){
        this.loading = true;
        this.errors = null;
        axios.post('/api/kategorie', this.category)
          .then(response =>{
            // this.category = response.data.category;
            this.loading = false;
          })
      }

    }
}
</script>