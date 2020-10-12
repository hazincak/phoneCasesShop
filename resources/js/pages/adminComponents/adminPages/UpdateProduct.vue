<template>
    <div class="container">
        <div v-if="loading">
                <atom-spinner class="my-center"
                :animation-duration="1000"
                :size="80"
                :color="'#086972'"
            />
        </div>
        <div v-else class="mb-5">
            <h3 class="underlined-header mt-5">Aktualizovať produkt</h3>
             <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Názov produktu</label>
                        <input 
                            type="text"
                            class="form-control"
                            v-model="editedProductData.title"
                            name="title"
                            :placeholder="product.title"
                            :class="[{'is-invalid': errorFor('title')}]"
                            >
                    </div>
                    <div class="form-group">
                        <label for="description_short">Stručný popis produktu</label>
                        <textarea 
                            class="form-control"
                            v-model="editedProductData.description_short"
                            name="description_short"
                            :placeholder="product.description_short"
                            :class="[{'is-invalid': errorFor('description_short')}]"
                            >
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description_long">Detailný popis produktu</label>
                        <textarea 
                            class="form-control"
                            v-model="editedProductData.description_long"
                            name="description_long"
                            :placeholder="product.description_long"
                            rows="5"
                            :class="[{'is-invalid': errorFor('description_long')}]"
                            >
                        </textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="price">Cena produktu</label>
                    <input 
                        type="text"
                        class="form-control"
                        v-model="editedProductData.price"
                        name="price"
                        :placeholder="product.price"
                        :class="[{'is-invalid': errorFor('price')}]"
                        >
                    </div>
                </div>
             </div>
            <div v-for="(image, index) in product.images" :key="index">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div v-if="image.path">
                            <img :src="image.path" class="img img-thumbnail">
                            <button class="btn btn-secondary" @click="removeImage(index)">Odstrániť obrázok</button>
                        </div>
                        <div v-else>
                            <img :src="image" class="img img-thumbnail">
                            <button class="btn btn-secondary" @click="removeImage(index)">Odstrániť obrázok</button>
                        </div>
                        
                    
                    </div>
                </div>
            </div>
            <div v-if="addPicture">
                <label for="obrazky">Vyberte obrázok </label>
                    <div class="input-group mb-3" name = "obrazky">
                        
                        <div class="custom-file">
                                <input type="file" name="obrazky" class="custom-file-input" id="inputGroupFile01" @change="onFileChange">
                                <label class="custom-file-label" for="inputGroupFile01">Vyberte obrázok </label>
                        </div>
                    </div>
            </div>
            <div v-if="!addPicture" class="row justify-content-center mt-2">
                <div class="col-md-5">
                    <button class="btn btn-secondary" @click="addPicture = true"><i class="fas fa-plus"></i> Pridať obrázok</button>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <button class="btn btn-success btn-block btn-lg" >Aktualizovať produkt</button>
                </div>
            </div>
            <!-- row between -->
        </div>
        <!-- v-else -->
    </div>
    <!-- container -->
</template>

<script>
import {is404, is422} from "./../../../shared/utils/response";
import validationErrors from "../../../shared/mixins/validationErrors";
export default {
    mixins:[validationErrors],
    data(){
        return{
            loading:false,
            product:{},
            addPicture: false,

            editedProductData:{
            title: null,
            description_short: null,
            description_long: null,
            images:[],
            price: null,
            },
        }
    },

    created(){
        this.loading = true;
         axios.get(`/api/obchod/produkt-podla-id/${this.$route.params.id}`)
            .then(response => {
                this.product = response.data
                this.loading = false;
            });
    },

    methods:{
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
    }
    }
}
</script>
<style scoped>
img {
  min-width: 20%;
  max-width: 20%;
  max-block-size: -webkit-fill-available;
  margin: auto;
  display: inline;
}
</style>