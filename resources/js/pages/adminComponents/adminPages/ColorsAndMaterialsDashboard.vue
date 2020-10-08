<template>
<div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
</div>
<div v-else>
  <div class="m-5"><h3>Správca farieb & materiálov</h3></div>
    <div class="row">
        <div class="col-md-8">
         <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Farby</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Farba</th>
                          <th>Vymazať</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Farba</th>
                          <th>Vymazať</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="color in colors" :key="color.id">
                          <tr>
                            <td>{{color.id}}</td>
                            <td>{{color.color}}</td>
                            <td><b-button class="btn btn-danger" @click="showColorConfirmationModal(color)"><i class="fas fa-trash-alt"></i> Odstrániť</b-button></td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="color">Pridať farbu</label>
                    <input 
                    type="text" 
                    class="form-control" 
                    v-model="color.color"
                    name="color"
                    placeholder="Názov novej farby"
                    :class="[{'is-invalid': errorFor('color')}]"
                    >
                    <v-errors :errors="errorFor('color')"></v-errors>
            </div>
            
                  <button 
                     @click="addColor"
                     class="btn btn-lg btn-success" 
                     >Pridať farbu</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
         <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Materiály</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Materiál</th>
                          <th>Vymazať</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Materiál</th>
                            <th>Vymazať</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="material in materials" :key="material.id">
                          <tr>
                            <td>{{material.id}}</td>
                            <td>{{material.material}}</td>
                            <td><b-button class="btn btn-danger" @click="showMaterialConfirmationModal(material)"><i class="fas fa-trash-alt"></i> Odstrániť</b-button></td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="material">Pridať materiál</label>
                    <input 
                    type="text" 
                    class="form-control" 
                    v-model="material.material"
                    name="material"
                    placeholder="Názov noveho materiálu"
                    :class="[{'is-invalid': errorFor('material')}]"
                    >
                    <v-errors :errors="errorFor('material')"></v-errors>
            </div>
            
                  <button 
                     @click="addMaterial"
                     class="btn btn-lg btn-success" 
                     >Pridať materiál</button>
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
      loading:false,
      colors:{},
      materials:{},
      color:{
        color:null,
      },
      material:{
        material:null,
      },
      colorConfirmedDeletion: '',
      materialConfirmedDeletion: ''
    }
  },

  created(){
    this.loading = true;
    axios.get('/api/farba')
      .then(response =>{
        this.colors = response.data
         this.loading = false;
      });
    axios.get('/api/material')
      .then(response => {
        this.materials = response.data
        this.loading = false;
      });
  },

  methods:{
     async addColor(){
      this.loading = true;
      this.errors = null;

      await axios.post('/api/farba', this.color)
        .then(response=> {
          if(200 == response.status){
            const fetchedData = response.data;
            this.colors.push(fetchedData);
            this.flashMessage.info({
               title: `Farba úspěšné vytvorená`,
               icon: false,
               message: `Farba "${fetchedData.color}" vytvorená`
            });
          }
          
        })
        .catch(err => {
          if(is422){
            const errors = err.response.data.errors;
            if (errors['color'] && 1 === _.size(errors)){
              this.errors = errors;
              return
            }
          }
        })
        .then(() => this.loading = false)
    },

    showColorConfirmationModal(color) {
        this.colorConfirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Naozaj chcete odstrániť farbu "${color.color}" ? Farba sa odstráni zo všetkých už pridaných produktov.`,  {
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
            this.colorConfirmedDeletion = value
            if(this.colorConfirmedDeletion){
              this.deleteColor(color)
            }
          })
          .catch(err => {
            // An error occurred
          })
      },

    deleteColor(color){
      this.loading = true;
        axios.delete(`/api/farba/${color.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.colors.indexOf(color);
                this.colors.splice(index,1);
                this.flashMessage.error({
                  title: 'Farba úspěšné vymazaná',
                  icon: false,
                  message: `Farba "${color.color}" vymazaná`
                  });
            });
    },

    async addMaterial(){
      this.loading = true;
      this.errors = null;

      await axios.post('/api/material', this.material)
        .then(response=> {
          if(200 == response.status){
              const fetchedData = response.data;
              this.materials.push(fetchedData);
              this.flashMessage.info({
               title: `Materiál úspěšné vytvorený`,
               icon: false,
               message: `Materiál "${fetchedData.color}" vytvorený`
            });
          }
        })
        .catch(err => {
          if(is422){
            const errors = err.response.data.errors;
            if (errors['material'] && 1 === _.size(errors)){
              this.errors = errors;
              return
            }
          }
        })
        .then(() => this.loading = false)
    },

    showMaterialConfirmationModal(material) {
        this.materialConfirmedDeletion = ''
        this.$bvModal.msgBoxConfirm(`Naozaj chcete odstrániť materiál "${material.material}" ? Materiál sa odstráni zo všetkých už pridaných produktov.`,  {
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
            this.materialConfirmedDeletion = value
            if(this.materialConfirmedDeletion){
              this.deleteMaterial(material)
            }
          })
      },

    deleteMaterial(material){
      this.loading = true;
        axios.delete(`/api/material/${material.id}`)
            .then(response =>{
                this.loading = false;
                let index = this.materials.indexOf(material);
                this.materials.splice(index,1);
                this.flashMessage.error({
                  title: 'Materiál úspěšné vymazaný',
                  icon: false,
                  message: `Materiál "${material.material}" vymazaný`
                  });
            });
    }
  }
}
</script>