<template>
    <div class="container-fluid admin-section">
        <div class="row">
            <admin-sidebar :isActive = "isActive" v-on:sidebar-change = "changeSideBarStatus($event)"></admin-sidebar>
            <div class="col">
                <div class="row">
                    <div class="sidebar__toggler" @click="isActive = !isActive">Menu <i class="fas fa-bars"></i></div>
                </div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>


import AdminSidebar from "./adminComponents/AdminSidebar";
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