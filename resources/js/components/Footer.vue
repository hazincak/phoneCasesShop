<template>
    <div class="section-footer">
        <div class="container-fluid">
            <div class="row">
                <div class = "col-lg-4 text-center">
                    <router-link :to="{name: 'reklamacny-poriadok'}">Reklamačný poriadok</router-link>
                    
                </div>
                <div class = "col-lg-4 text-center">
                    <router-link :to="{name: 'obchodne-podmienky'}"><i class="fas fa-list-ol"></i> Obchodné podmienky</router-link>
                </div>
                <div class = "col-lg-4 text-center">
                    <router-link :to="{name: 'ochrana-osobnych-udajov'}"><i class="fas fa-shield-alt"></i> Ochrana osobných údajov</router-link>
                </div>
            </div>
            <div class="row">
                <div class = "col-lg-12 text-center mt-2">
                    © Copyright 2020 najlacnejsieobaly.shop
                </div>
            </div>
        </div>
    </div>
</template>
