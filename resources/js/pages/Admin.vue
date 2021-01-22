<template>
    <div class="container-fluid pt-5 section">
        <div class="row">
            <admin-sidebar></admin-sidebar>
            <div class="col">
                <div class="row ml-5">
                    <div class="sidebar__toggler" v-b-toggle.sidebar-no-header>Menu <i class="fas fa-bars"></i></div>
                </div>
                <div >
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import AdminSidebar from "../components/adminComponents/AdminSidebar";

export default {
 components:{
        AdminSidebar
    },
}
</script>
