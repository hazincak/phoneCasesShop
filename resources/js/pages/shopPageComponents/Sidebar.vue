<template>
<div class="sidebar__wrapper" :class="{active: isActive}">
   
   
   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">
        
        <div class="sidebar-header">
            <h2 class="text-center">Menu</h2>
        </div>
        <div class="sidebar-subheader">
                <h3 class="text-center">Kategorie produktov</h3>
            </div>

        <ul class="list-group">
            <transition-group name="fade">            
            <li v-for="category in sidebarListItems" :key="category.id" class="text-left" @click="selectedCategory = category.id"> 
               {{category.category_name}}
               <transition name="fade"> 
                <div v-if="selectedCategory == category.id" >
                    
                     <ul class="list-group ml-3" v-for="brand in category.brands" :key="brand.id"  @click="selectedBrand = brand.id">{{brand.brand_name}}
                        <transition name="fade">
                        <div v-if="selectedBrand == brand.id" >
                             <ul class="list-group ml-4" v-for="model in brand.device_models" :key="model.id">{{model.model_name}}</ul>
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
export default {
    props:{
        isActive: Boolean,
    },

    data(){
        return{
            sidebarListItems:{},
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

    methods:{
      
        
    }


}
</script>




