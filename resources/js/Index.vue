<template>
    <div>
        <navbar></navbar>
        
        <router-view :key="$route.path"></router-view>
        
        <section-footer></section-footer>
        <FlashMessage :position="'right bottom'"></FlashMessage>
    </div>
</template>
