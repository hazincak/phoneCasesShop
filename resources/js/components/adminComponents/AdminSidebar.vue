<template>
    <div>
        <b-sidebar id="sidebar-no-header" aria-labelledby="sidebar-no-header-title" no-header shadow>
          <template #default="{ hide }">
            <div class="p-3">
              <h4 id="sidebar-no-header-title">Admin sidebar</h4>
               <ul class="list-group ml-5">
           <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'BrandsDashboard'}">Brands & Models</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ColorsAndMaterialsDashboard'}">Colours & Materials</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'CategoriesDashboard'}">Categories</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ProductsDashboard'}">All products</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ManageCarousel'}">Manage carousel</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ReturnAndRefundPolicy'}">Returns & Refunds</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'TermsAndConditions'}">Terms & Conditions</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'Gdpr'}">GDPR</router-link>
            </li>
        </ul>
              <b-button variant="primary" block @click="hide">Close Sidebar</b-button>
            </div>
          </template>
        </b-sidebar>
    </div>
<!-- <div class="sidebar__wrapper" :class="{active: isActive}">


   <div v-if="isActive" class="sidebar__closeButton" @click="$emit('sidebar-change', !isActive)"><i class="far fa-times-circle"></i></div>
    <nav id="sidebar">

        <div class="p-5">
            <h1 class="text-center">Admin section</h1>
        </div>

        <ul class="list-group ml-5">
           <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'BrandsDashboard'}">Brands & Models</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ColorsAndMaterialsDashboard'}">Colours & Materials</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'CategoriesDashboard'}">Categories</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ProductsDashboard'}">All products</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ManageCarousel'}">Manage carousel</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'ReturnAndRefundPolicy'}">Returns & Refunds</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'TermsAndConditions'}">Terms & Conditions</router-link>
            </li>
            <li class="text-left mb-4 mt-4">
                <router-link class="sidebar--link-main underline--magical" :to="{name: 'Gdpr'}">GDPR</router-link>
            </li>
        </ul>
    </nav>

</div> -->
</template>
<script>
export default {
    props:{
        isActive: Boolean
    },
}
</script>




