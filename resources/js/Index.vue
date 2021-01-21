<template>
    <div>
        <navbar></navbar>
        <div class="section">
            <router-view :key="$route.path"></router-view>
        </div>

        <section-footer></section-footer>
        <FlashMessage :position="'right bottom'"></FlashMessage>
    </div>
</template>

