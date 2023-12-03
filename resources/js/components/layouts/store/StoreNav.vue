<script lang="ts">
import {defineComponent} from 'vue'
import {Cart} from "../../../store/Cart.ts";
import Button from "primevue/button";
import {ShoppingCartIcon} from "@heroicons/vue/24/solid/index.js";
export default defineComponent({
    name: "StoreNav",
    data() {
        return {
            cart: Cart,
        }
    },
    components: {ShoppingCartIcon, Button}
})
</script>

<template>
    <div class="flex justify-between pt-4 px-5">
        <router-link class="flex" to="cart">
            <ShoppingCartIcon class="h-8 w-8 text-primary" />
            <div class="bg-primary h-8 px-3 text-white font-bold rounded text-center pt-1 ml-2">
                {{cart.state.products.length}}
            </div>
        </router-link>
        <div class="flex">
            <router-link :to="{name: 'task'}"><Button class="mr-3" label="View Tasks" /></router-link>
            <router-link :to="{name: 'cart'}"><Button label="View Cart" /></router-link>
        </div>
    </div>
</template>

<style scoped>

</style>
