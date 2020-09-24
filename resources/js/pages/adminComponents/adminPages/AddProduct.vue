<template>
    <div v-if="loading">
        <atom-spinner class="my-center"
          :animation-duration="1000"
          :size="80"
          :color="'#086972'"
        />
    </div>
    <div v-else class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <div>
            <h2>Pridať produkt</h2>
            <hr>
        </div>
            <div class="form-group">
                <label for="title">Názov produktu</label>
                <input 
                    type="text"
                    class="form-control"
                    v-model="product.title"
                    name="title"
                    placeholder="Názov"
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
                    >
                </textarea>
            </div>
       
        
            <div class="form-group">
                <label for="category">Kategória produktu</label>
                <select 
                    class="form-control"
                    name="category"
                    v-model="product.category">
                        <option disabled value="">Vyberte kategóriu</option>
                        <option v-for="category in categories" :key="category.id">{{category.category_name}}</option>
                </select>
            </div>
        
        
            <div class="form-group">
                <label for="brand">Značka produktu</label>
                <select 
                    class="form-control"
                    v-model="product.brand"
                    name="brand"
                    
                    @change="getModels(product.brand_id)"
                    >
                        <option disabled value="">Vyberte značku</option>
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id"  >{{brand.brand_name}}</option>
                </select>
            </div>
      
        
            <div class="form-group ml-5">
                <label for="model">Model produktu</label>
                <select 
                    class="form-control"
                    v-model="product.model"
                    name="model"
                    :disabled="disabled"
                    >
                        <option disabled value="">Vyberte model</option>
                        <option v-for="(model, index) in models" :key="index">{{model.model_name}}</option>
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
                <div v-for=" index in Number(images_count)" :key="index" >
                    <div class="form-group">
                        <div class="ml-5">
                            <label for="obrazky">Obrázok {{index}}</label>
                            <div class="input-group mb-3" name = "obrazky">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Vyber obrázok {{index}} </label>
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
                        v-model="product.color"
                        name="price"
                        placeholder="Cena"
                        >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="color">Farba produktu</label>
                    <input 
                        type="text"
                        class="form-control"
                        v-model="product.color"
                        name="color"
                        placeholder="Farba"
                        >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="material">Materiál produktu</label>
                    <input 
                        type="text"
                        class="form-control"
                        v-model="product.material"
                        name="material"
                        placeholder="Materiál"
                        >
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <button class="btn btn-success btn-block btn-lg">Pridať produkt</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
    return {
        loading:false,
        images_count: null,
        disabled: true,

        product:{
            title: null,
            description_short: null,
            description_long: null,
            category: '',
            model: '',
            brand_id: '',
           
            price: null,
            color: null,
            material: null
            },
        
        categories:{},
        brands: {},
        models: {},
        }
    },

    created(){
        this.loading = true;
        axios.get('/api/kategorie')
        .then(response => {
            this.categories = response.data
        });
        axios.get('/api/znacky')
        .then(response => {
            this.brands = response.data
             this.loading = false
        });
       
    },

    methods:{
        getModels(brand){
            this.loading = true;
            axios.get(`/api/modely-podla-znacky/${this.product.brand}`)
                .then(response => (this.models = response.data))
                .then(()=>{
                     this.loading = false;
                    this.disabled = false;
                });
            
        }
    }
}
</script>
