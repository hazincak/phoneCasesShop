<template>
    <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
    </div>
     <div  v-else >
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Názov produktu</label>
                <input 
                    type="text"
                    class="form-control"
                    v-model="product.title"
                    name="title"
                    placeholder="Názov"
                    :class="[{'is-invalid': errorFor('title')}]"
                    >
                    
            </div>
        
        
            <div class="form-group">
                <label for="description_short">Stručný popis produktu</label>
                <textarea 
                    class="form-control"
                    v-model="product.description_short"
                    name="description_short"
                    placeholder="Krátky popis"
                    rows="3"
                    :class="[{'is-invalid': errorFor('description_short')}]"
                    >
                    
                </textarea>
            </div>
        
        
            <div class="form-group">
                <label for="description_long">Detailný popis produktu</label>
                <textarea 
                    class="form-control"
                    v-model="product.description_long"
                    name="description_long"
                    placeholder="Dlhý popis"
                    rows="5"
                    :class="[{'is-invalid': errorFor('description_long')}]"
                    >
                    
                </textarea>
            </div>
       
        
            <div class="form-group">
                <label for="category">Kategória produktu</label>
                <select 
                    class="form-control"
                    name="category"
                    @change="getBrandsBelongingToSelectedCategory(product.category_id)"
                    v-model="product.category_id"
                    :class="[{'is-invalid': errorFor('category_id')}]">
                        <option disabled value="">Vyberte kategóriu</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.category_name}}</option>
                </select>
                
            </div>
        
        
            <div class="form-group">
                <label for="brand">Značka produktu</label>
                <select 
                    class="form-control"
                    v-model="product.brand_id"
                    name="brand"
                    :disabled="disabledBrandForm"
                    @change="getModelsBelongingToSelectedBrand(product.brand_id)"
                    :class="[{'is-invalid': errorFor('brand_id')}]"
                    >
                        <option disabled value="">Vyberte značku</option>
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id"  >{{brand.brand_name}}</option>
                </select>
            </div>
      
        
            <div class="form-group">
                <label for="model">Model produktu</label>
                <select 
                    class="form-control"
                    v-model="product.model_id"
                    name="model"
                    :disabled="disabledModelForm"
                    :class="[{'is-invalid': errorFor('model_id')}]"
                    >
                        <option disabled value="">Vyberte model</option>
                        <option v-for="model in models" :key="model.id" :value="model.id">{{model.model_name}}</option>
                </select>
            </div>
             <div class="form-group">
                    <label for="count">Počet obrázkov produktu</label>
                    <select 
                        class="form-control"
                        v-model="images_count"
                        name="count"
                        >
                            <option disabled value="">Vyberte počet</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                    </select>
            </div>

            <div v-if="images_count">
                <div v-for="index in Number(images_count)" :key="index">
                    <div class="form-group ml-5">    
                        
                        <div v-if="product.images[index-1]" class="ml-5">
                                    <div class="d-flex justify-content-around">
                                        <div class="p-2 flex-fill">
                                            <img :src="product.images[index-1]" class="img img-thumbnail">
                                        </div>
                                        <div class="p-2 flex-fill align-self-center">
                                            <button class="btn btn-secondary" @click="removeImage(index)">O dstrániť obrázok</button>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                </div>
                        <div v-else>
                            <label for="obrazky">Vyberte obrázok {{index}} </label>
                             <div class="input-group mb-3" name = "obrazky">
                                
                                <div class="custom-file">
                                        <input type="file" name="obrazky" class="custom-file-input" id="inputGroupFile01" @change="onFileChange">
                                        <label class="custom-file-label" for="inputGroupFile01">Vyberte obrázok </label>
                                </div>
                            </div>
                        </div>

                           
                    </div>
                </div>
            </div>
            

      
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="price">Cena produktu</label>
                    <input 
                        type="text"
                        class="form-control"
                        v-model="product.price"
                        name="price"
                        placeholder="Cena"
                        :class="[{'is-invalid': errorFor('price')}]"
                        >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="color">Farba produktu</label>
                    <select 
                        class="form-control"
                        v-model="product.color_id"
                        name="color"
                        :class="[{'is-invalid': errorFor('color')}]"
                        >
                        <option value="">Vyberte farbu</option>
                        <option v-for="color in colors" :key="color.id" :value="color.id">{{color.color}}</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="material">Materiál produktu</label>
                    <select 
                        type="text"
                        class="form-control"
                        v-model="product.material_id"
                        name="material"
                        placeholder="Materiál"
                        :class="[{'is-invalid': errorFor('material')}]"
                        >
                        <option value="">Vyberte materiál</option>
                        <option v-for="material in materials" :key="material.id" :value="material.id">{{material.material}}</option>
                    </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <button class="btn btn-success btn-block btn-lg" @click="createProduct">Pridať produkt</button>
        </div>
    </div>
        
    
     </div>
</template>

<script>
import {is404, is422} from "./../../../shared/utils/response";
import validationErrors from "../../../shared/mixins/validationErrors";
export default {
    mixins: [validationErrors],
    data() {
    return {
        loading:false,
        images_count: null,
        disabledBrandForm: true,
        disabledModelForm: true,

        product:{
            title: null,
            description_short: null,
            description_long: null,
            category_id: '',
            model_id: '',
            brand_id: '',
            images:[],
            price: null,
            color_id: null,
            material_id: null
            },
        
        categories:{},
        brands: {},
        models: {},
        colors: {},
        materials: {},
        }
    },

    created(){
        this.loading = true;
        axios.get('/api/kategorie')
        .then(response => {
            this.categories = response.data
        })
        .then(() => 

             this.loading = false
        );
        axios.get('/api/farba')
        .then(response =>{
            this.colors = response.data
        }).then(() => 

             this.loading = false
        );
        axios.get('/api/material')
        .then(response =>{
            this.materials = response.data
        }).then(()=>
            this.loading = false
        );       
    },


    methods:{

        getBrandsBelongingToSelectedCategory(id){
            this.loading = true;
            axios.get(`/api/znacky-patriace-kategorii/${id}`)
                .then(response => (this.brands = response.data))
                .then(()=>{
                     this.loading = false;
                    this.disabledBrandForm = false;
                });
            
        },

        getModelsBelongingToSelectedBrand(brandId){
            this.loading = true;
            axios.get(`/api/modely-podla-kategorie/${this.product.category_id}/znacky/${brandId}`)
                .then(response => (this.models = response.data))
                .then(()=>{
                     this.loading = false;
                    this.disabledModelForm = false;
                });
            
        },

        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
            this.createImage(files[0]);
        },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                //   vm.product.images = e.target.result;
                vm.product.images.push(e.target.result);
                };
                reader.readAsDataURL(file);
        },
            removeImage: function (e) {
              this.product.images.pop(e);
        },

       async createProduct(){
            this.loading = true;
        this.errors = null;

       try {
          const response =  await axios.post('/api/produkt', this.product);
          if(200 == response.status){
              this.flashMessage.info({
               title: `Produkt úspěšné vytvorený `,
               icon: false,
               message: `Produkt s názvom "${this.product.title}" vytvorený`
               
            });
            
          }
       } catch (error) {
           this.errors = error.response && error.response.data.errors;
       }
       this.loading = false;
        
         
        }

    }
}
</script>
<style scoped>
img {
  max-width: 20%;
  max-block-size: -webkit-fill-available;
  margin: auto;
  display: block;
}
</style>
