<template>
<div>
    <b-sidebar
      id="sidebar-backdrop"
      :backdrop-variant="dark"
      backdrop
      shadow
    >
        <div class="p-5">
            <h1 class="text-center">Menu</h1>
        </div>
        <ul class="list-group ml-5">
            <transition-group name="fade">
            <li v-for="category in sidebarListItems" :key="category.id"  class="text-left mb-4 mt-4" @click="selectedCategory = category.id;">
               <span class="sidebar--link-main underline--magical">{{category.category_name}}</span>
               <transition name="fade">
                <div v-if="selectedCategory == category.id" >

                     <ul class="list-group ml-4 mb-4 mt-4" v-for="brand in category.brands" :key="brand.id"  @click="selectedBrand = brand; getFilteredModels(selectedCategory)">
                         <span class="sidebar--link">{{brand.brand_name}}</span>
                        <transition name="fade">
                        <div v-if="selectedBrand.id == brand.id" >
                            <ul class="list-group ml-4 mt-4" v-for="model in filteredModels" :key="model.id">
                                 <router-link class="sidebar--link" :to="{name: 'shop-selection', params: { categoryId: selectedCategory, brandId: model.brand_id ,modelId: model.id  }}">{{model.model_name}}</router-link>
                            </ul>
                        </div>
                        </transition>
                     </ul>

                </div>
                </transition>

            </li>
            </transition-group>
        </ul>
    </b-sidebar>
</div>

</template>
<script>
export default {

    data(){
        return{
            sidebarListItems:[],
            selectedCategory: null,
            selectedBrand: {},
            filteredModels: null,
        }
    },

    created(){
        axios.get('/api/sidebar/kontent')
        .then(response => {
            this.sidebarListItems = response.data
        })
    },

    watch:{
        selectedCategory : function(){
             this.filteredModels = null
        }
    },

    methods:{
        getFilteredModels(categoryId){
            this.filteredModels = null
            this.filteredModels = _.filter(this.selectedBrand.device_models, function (model){
            return _.some(model.categories, ['id', categoryId]);
        })
        },
    }


}
</script>




