<template>
    <div class="container-fluid section">
        <div class="row">
            <admin-sidebar></admin-sidebar>
            <div class="col">
                <div class="row ml-5">
                    <div class="sidebar__toggler" v-b-toggle.sidebar-no-header>Menu <i class="fas fa-bars"></i></div>
                </div>
                <div class="m-5">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import AdminSidebar from "../components/adminComponents/AdminSidebar";
import {mapState ,mapGetters} from "vuex";

export default {
 components:{
        AdminSidebar
    },

data(){
    return{
        isActive:false,
    }
},

methods:{
     changeSideBarStatus(status){
            this.isActive =  status
        },
}


}
</script>
