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
            <h2 class="underlined-header mt-5">Update product</h2>
             <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-4">
                    <h3>Product details</h3>
                    <p><strong>Product title</strong></p>
                    <p>{{product.title}}</p>
                    <p><strong>Short description</strong></p>
                    <p>{{product.description_short}}</p>
                    <p><strong>Detailed description</strong></p>
                    <p>{{product.description_long}}</p>
                    <p><strong>Price</strong></p>
                    <p>{{product.price}}</p>

                </div>
                <div class="col-md-8">
                    <h3>New product details</h3>
                    <div class="form-group">
                        <label for="title">Product title</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="editedProduct.title"
                            name="title"
                            :placeholder="product.title"
                            :class="[{'is-invalid': errorFor('title')}]"
                            >
                    </div>
                    <div class="form-group">
                        <label for="description_short">Short description</label>
                        <textarea
                            class="form-control"
                            v-model="editedProduct.description_short"
                            name="description_short"
                            :placeholder="product.description_short"
                            :class="[{'is-invalid': errorFor('description_short')}]"
                            >
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description_long">Long description</label>
                        <textarea
                            class="form-control"
                            v-model="editedProduct.description_long"
                            name="description_long"
                            :placeholder="product.description_long"
                            rows="5"
                            :class="[{'is-invalid': errorFor('description_long')}]"
                            >
                        </textarea>
                    </div>
                    <div class="form-group">
                    <label for="price">Price (€)</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="editedProduct.price"
                        name="price"
                        :placeholder="product.price"
                        :class="[{'is-invalid': errorFor('price')}]"
                        >

                    </div>
                <div v-for="(image, index) in product.images" :key="index">
                    <div class="row justify-content-center">
                        <div class="card" style="width: 18rem">
                            <div v-if="image.path">
                                <img :src="image.path" class="card-img-top">
                                <button class="btn btn-secondary" @click="removeExistingImage(index, image)">Delete Image</button>
                            </div>
                            <div v-else>
                                <img :src="image" class="img img-thumbnail">
                                <button class="btn btn-secondary" @click="removeImage(index)">Delete image</button>
                            </div>


                        </div>
                        <!-- card -->
                    </div>
                </div>
            <div v-if="addPicture">
                <label for="obrazky">Select image</label>
                    <div class="input-group mb-3" name = "obrazky">

                        <div class="custom-file">
                                <input type="file" name="obrazky" class="custom-file-input" id="inputGroupFile01" @change="onFileChange">
                                <label class="custom-file-label" for="inputGroupFile01">Select image</label>
                        </div>
                    </div>
            </div>
            <div v-if="!addPicture" class="row justify-content-center mt-2">
                <div class="col-md-5">
                    <button class="btn btn-secondary" @click="addPicture = true"><i class="fas fa-plus"></i> Add image</button>
                </div>
            </div>
                </div>
                </div>


            <div class="row justify-content-center mb-5">
                <div class="col-md-6">
                    <button class="btn btn-success btn-block btn-lg" @click="updateProduct" >Update product</button>
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
            editedProduct:{
                title:null,
                description_short:null,
                description_long:null,
                price:null,
                addedImages: [],
                deletedImages:[],
            },
            addPicture: false,
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
                this.editedProduct.addedImages.push(e.target.result)
                };
                reader.readAsDataURL(file);
        },
        removeExistingImage: function (index, image) {
            this.product.images.splice(index, 1);
            this.editedProduct.deletedImages.push(image)
        },
        removeImage: function(index){
            this.product.images.splice(index, 1);
        },
        async updateProduct(){
        this.loading = true;
        this.errors = null;

       try {
          const response =  await axios.put(`/api/produkt/${this.product.id}`, this.editedProduct);
          if(200 == response.status){
              this.flashMessage.info({
               title: `Product successfully updated`,
               icon: false,
               message: `Product "${this.product.title}" has been updated`
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
