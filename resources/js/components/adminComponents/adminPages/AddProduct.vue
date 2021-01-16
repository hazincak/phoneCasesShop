<template>
    <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
    </div>
    <div  v-else >
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Product name</label>
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
                <label for="description_short">Short product description</label>
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
                <label for="description_long">Detailed product description</label>
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
                <label for="category">Product category</label>
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
                <label for="brand">Product brand</label>
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
                <label for="model">Product model</label>
                <select
                    class="form-control"
                    v-model="product.model_id"
                    name="model"
                    :disabled="disabledModelForm"
                    :class="[{'is-invalid': errorFor('model_id')}]"
                    >
                        <option disabled value="">Select model</option>
                        <option v-for="model in models" :key="model.id" :value="model.id">{{model.model_name}}</option>
                </select>
            </div>
            <div class="form-group">
                <div v-for="(image, index) in product.images" :key="index">
                    <div class="row justify-content-center">


                        <div class="card" style="width: 18rem;">
                            <img :src="product.images[index]" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span v-if="index === 0">Main image</span>
                                    <span v-else>Image {{index + 1}}</span>
                                </h5>
                                <button class="btn btn-secondary" @click="removeImage(index)">Odstrániť obrázok</button>
                            </div>

                        </div>
                        <!-- card             -->
                    </div>
                    <!-- row -->
                </div>
                <!-- for loop -->
            </div>
                <div v-if="addPicture">
                <label for="obrazky">Add image </label>
                    <div class="input-group mb-3" name = "obrazky">

                        <div class="custom-file">
                                <input type="file" name="obrazky" class="custom-file-input" id="inputGroupFile01" @change="onFileChange">
                                <label class="custom-file-label" for="inputGroupFile01">Vyberte obrázok </label>
                        </div>
                    </div>
                </div>
                <div v-if="!addPicture" class="row justify-content-left m-2">
                    <div class="col-md-5">
                        <button class="btn btn-secondary" @click="addPicture = true"><i class="fas fa-plus"></i> Pridať obrázok</button>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="price">Price (€)</label>
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
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="color">Colour</label>
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
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="material">Material</label>
                    <select
                        type="text"
                        class="form-control"
                        v-model="product.material_id"
                        name="material"
                        placeholder="Materiál"
                        :class="[{'is-invalid': errorFor('material')}]"
                        >
                        <option value="">Select material</option>
                        <option v-for="material in materials" :key="material.id" :value="material.id">{{material.material}}</option>
                    </select>
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
        // images_count: null,
        disabledBrandForm: true,
        disabledModelForm: true,
        addPicture: false,

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
                this.product.images.splice(e, 1);
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
.card-img-top {
    width: 100%;
    height: 10vw;
    object-fit: cover;
}
</style>
