<template>
    <div class="section-footer">
        <div class="container-fluid">
            <div class="row">
                <div class = "col-lg-4 text-center">
                    <router-link :to="{name: 'rules-of-returns'}"><i class="fas fa-list-ul"></i>&nbsp;Return & Refund Policy </router-link>

                </div>
                <div class = "col-lg-4 text-center">
                    <router-link :to="{name: 'trading-terms'}"><i class="fas fa-list-ol"></i>&nbsp;Trading Terms</router-link>
                </div>
                <div class = "col-lg-4 text-center">
                    <router-link :to="{name: 'gdpr'}"><i class="fas fa-shield-alt"></i>&nbsp;GDPR</router-link>
                </div>
            </div>
            <div class="row">
                <div class = "col-lg-12 text-center mt-2">
                    © Copyright 2020
                </div>
            </div>
        </div>
    </div>
</template>
