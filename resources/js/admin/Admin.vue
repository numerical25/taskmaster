<template>
    <div class="h-screen overflow-y-auto bg-primary-reverse">
        <Header></Header>
        <router-view></router-view>
        <Footer></Footer>
    </div>
</template>
<script lang="ts">
import {Cart} from "../store/Cart.js";
import Header from "./components/layouts/Header.vue";
import Footer from "../components/layouts/Footer.vue";
export default {
    components: {Header, Footer},
    created() {
        Cart.commit('initialiseStore');
    },
    data() {
        return {
            message: 'Hello, world!',
        };
    },
};
</script>
<style>
@font-face {
    font-family: 'MyFont';
    src: url('/fonts/Old_London.ttf');
}
.btn {
    @apply font-bold py-2 px-4 rounded;
}
.btn-blue {
    @apply bg-blue-500 text-white;
}
.btn-blue:hover {
    @apply bg-blue-700;
}
.btn-red {
    @apply btn bg-red-800 text-white;
}
.btn-primary {
    @apply btn btn-blue;
}
.bg-primary {
    @apply bg-white;
}

.text-primary {
    @apply text-green-800;
}
.text-box-primary {
    @apply appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
}
</style>
