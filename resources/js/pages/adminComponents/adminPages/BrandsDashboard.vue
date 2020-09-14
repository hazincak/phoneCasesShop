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
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Značky produktov</h3>
                </div>
                <div class="card-body mt-5">
                  <div class="table-responsive table-hover">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Názov značky</th>
                          <th>Vytvorená</th>
                          <th>Aktualizovaná</th>
                          <th>Odstrániť</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Názov značky</th>
                          <th>Vytvorená</th>
                          <th>Aktualizovaná</th>
                          <th>Odstrániť</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="item in brands" :key = item.id >
                            <tr>
                                <td>{{item.id}}</td>
                                <td><router-link :to="{name:'brandUpdate', params: {id: item.id}}">{{item.brand_name}}</router-link></td>
                                <td>{{item.created_at | fromNow}}</td>
                                <td>{{item.created_at | fromNow}}</td>
                                <td><button class="btn btn-danger btn-lg" @click="deleteBrand(item)"><i class="fas fa-trash-alt"></i> Odstrániť</button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="form-group">
            <label for="brand_name">Pridať značku produktu</label>
                <input 
                type="text" 
                class="form-control" 
                v-model="brand.brand_name"
                name="brand_name"
                placeholder="Názov novej značky"
                :class="[{'is-invalid': errorFor('brand_name')}]"
                 >
                 <v-errors :errors="errorFor('brand_name')"></v-errors>
            </div>
                  <button 
            @click="addBrand"
            class="btn btn-lg btn-success " 
            >Pridať značku</button>
           
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
            error: false,
            brands: {},
            brand:{
                brand_name:null
            }
        }
    },

    created(){
        this.loading = true;
        axios.get('/api/znacky')
            .then(response =>{
                this.brands = response.data
                this.loading = false;
            });
    },

    methods:{
      deleteBrand(item){
        this.loading = true;
        axios.delete(`/api/znacky/${item.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.brands.indexOf(item);
                this.brands.splice(index,1);
                this.flashMessage.error({
                  title: 'Značka úspěšné vymazaná',
                  icon: false,
                  message: `Značka s názvom "${item.brand_name}" vymazaná`
                  });
            });
      },
     async addBrand(){
        this.success = null,
        this.loading = true;
        this.errors = null;

       
        await axios.post('/api/znacky', this.brand)
          .then(response=>{
            this.success = 201 === response.status;
            const fetchedData = response.data;
            this.brands.push(fetchedData);
            this.flashMessage.info({
               title: `Značka úspěšné vytvorená`,
               icon: false,
               message: `Značka s názvom "${fetchedData.brand_name}" vytvorená`
            });
          })
          .catch(err =>{
            if(is422(err)){
              const errors = err.response.data.errors;
              if (errors["brand_name"] && 1 === _.size(errors)) {
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