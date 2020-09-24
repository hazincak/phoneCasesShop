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
            <li v-for="(category, index) in productCategories" :key="index"  class="text-left mb-4 mt-4" @click="selectedCategory = category.id"> 
               <span class="sidebar--link">{{category.category.category_name}}</span>
               <transition name="fade"> 
                <div v-if="selectedCategory == category.id" >
                    
                     <ul class="list-group ml-4 mb-4 mt-4" v-for="brand in category.brands" :key="brand.id"  @click="selectedBrand = brand.id">
                         <span class="sidebar--link">{{brand.brand_name}}</span>
                        <transition name="fade">
                        <div v-if="selectedBrand == brand.id" >
                            <ul class="list-group ml-4 mb-4 mt-4" v-for="model in brand.device_models" :key="model.id">
                                 <span class="sidebar--link">{{model.model_name}}</span>
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
            selectedBrand: null
        }
    },

    created(){
        axios.get('/api/sidebar/kontent')
        .then(response => {
            this.sidebarListItems = response.data
        })
    },

//     computed: {
//         productCategories () {
//         // return uniq(this.sidebarListItems.map(({ category }) => category))

//         return _.uniqBy(this.sidebarListItems, 'category.category_name')
//   }
//     },

    methods:{
      
        
    }


}
</script>




