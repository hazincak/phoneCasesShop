<template>
<div class="sidebar__wrapper" :class="{active: isActive}">
   
   
   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">
        
        <div class="sidebar-header">
            <h1 class="text-center">Menu</h1>
        </div>
        <div class="sidebar-subheader">
                <h2 class="text-center">Kategorie produktov</h2>
            </div>

        <ul class="list-group">
            <transition-group name="fade">            
            <li v-for="category in sidebarListItems" :key="category.id"  class="text-left mb-4 mt-4" @click="selectedCategory = category.id;"> 
               <span class="sidebar--link">{{category.category_name}}</span>
               <transition name="fade"> 
                <div v-if="selectedCategory == category.id" >
                    
                     <ul class="list-group ml-4 mb-4 mt-4" v-for="brand in category.brands" :key="brand.id"  @click="selectedBrand = brand; getFilteredModels(selectedCategory)">
                         <span class="sidebar--link">{{brand.brand_name}}</span>
                        <transition name="fade">
                        <div v-if="selectedBrand.id == brand.id" >
                            <ul class="list-group ml-4 mb-4 mt-4" v-for="model in filteredModels" :key="model.id">
                                 <!-- <span class="sidebar--link">{{model.model_name}}</span> -->
                                 <router-link class="sidebar--link" :to="{name: 'Obaly na mobil', params: {model: model.model_name}}">{{model.model_name}}</router-link>
                            </ul>
                        </div>
                        </transition>
                     </ul>
                    
                </div>
                </transition>
                   
            </li>
            </transition-group>
        </ul>
    </nav>

</div>
</template>
<script>
import uniq from 'lodash/uniq';
export default {

    
    props:{
        isActive: Boolean,
    },

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
        }
        
    }


}
</script>




