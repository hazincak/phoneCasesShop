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
                  <h3 class="m-0 font-weight-bold text-secondary">Colours</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Colour</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Colour</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="color in colors" :key="color.id">
                          <tr>
                            <td>{{color.id}}</td>
                            <td>{{color.color}}</td>
                            <td><b-button class="btn btn-danger" @click="showColorConfirmationModal(color)"><i class="fas fa-trash-alt"></i> Delete</b-button></td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="color">Add colour</label>
                    <input
                    type="text"
                    class="form-control"
                    v-model="color.color"
                    name="color"
                    placeholder="New colour name"
                    :class="[{'is-invalid': errorFor('color')}]"
                    >
                    <v-errors :errors="errorFor('color')"></v-errors>
            </div>

                  <button
                     @click="addColor"
                     class="btn btn-lg btn-success"
                     >Add colour</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
         <div class="card shadow">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-secondary">Materials</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Material</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Material</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                        <tbody v-for="material in materials" :key="material.id">
                          <tr>
                            <td>{{material.id}}</td>
                            <td>{{material.material}}</td>
                            <td><b-button class="btn btn-danger" @click="showMaterialConfirmationModal(material)"><i class="fas fa-trash-alt"></i> Delete</b-button></td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="material">Add material</label>
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
                     >Add material</button>
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
               title: `Colour created successfully`,
               icon: false,
               message: `Colour "${fetchedData.color}" has been created`
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
        this.$bvModal.msgBoxConfirm(`Do you really want to delete "${color.color}" colour? This colour will be deleted from all products`,  {
          title: 'Please confirm',
          size: 'md',
          buttonSize: 'md',
          okVariant: 'danger',
          okTitle: 'Yes',
          cancelTitle: 'No ',
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
                  title: 'Colour successfully deleted',
                  icon: false,
                  message: `Colour "${color.color}" has been deleted`
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
               title: `Material successfully created`,
               icon: false,
               message: `Material "${fetchedData.material}" has been created`
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
        this.$bvModal.msgBoxConfirm(`Do you really want to delete "${material.material}" material? Material will be deleted from all existing products.`,  {
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
                  title: 'Material successfully deleted',
                  icon: false,
                  message: `Material "${material.material}" has been deleted`
                  });
            });
    }
  }
}
</script>
