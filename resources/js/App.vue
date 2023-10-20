<template>
    <div class="h-screen pb-10 overflow-y-auto">
        <div class="flex p-8 bg-green-800 overflow-y-auto">
            <h1 class="text-5xl font-bold text-white">The Social Machine</h1>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
import {Cart} from "./store/Cart.js";
export default {
    created() {
        Cart.commit('initialiseStore')
    },
    data() {
        return {
            message: 'Hello, world!',
        };
    },
};
</script>
<style>
.btn {
    @apply font-bold py-2 px-4 rounded;
}
.btn-blue {
    @apply bg-blue-500 text-white;
}
.btn-blue:hover {
    @apply bg-blue-700;
}
.btn-primary {
    @apply btn btn-blue;
}
.text-box-primary {

    @apply appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500;
}
</style>
