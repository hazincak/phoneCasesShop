<template>
<div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
</div>
<div v-else>
  <div class="m-5"><h3>Správca značiek & modelov</h3></div>
    <div class="row m-5">
        <div class="col-md-8">
         <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Značky produktov</h3>
                </div>
                <div class="card-body">
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
                                <td><b-button class="btn btn-danger" @click="showConfirmationModal(item)"><i class="fas fa-trash-alt"></i> Odstrániť</b-button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
            },
            confirmedDeletion: ''
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
      showConfirmationModal(item) {
        this.confirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Naozaj chcete odstrániť značku "${item.brand_name}"? Značka sa odstráni zo všetkých už pridaných produktov.`,  {
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
              this.deleteBrand(item)
            }
          })
      },
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
      addBrand(){
        this.loading = true;
        this.errors = null;

       
      axios.post('/api/znacky', this.brand)
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