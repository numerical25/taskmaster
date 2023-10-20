<script>
import {defineComponent} from 'vue'
import {Cart} from "../../store/Cart.js";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";

export default defineComponent({
    name: "Cart",
    components: {DefaultQuantityControl},
    data() {
        return {
            cart: Cart
        }
    },
    methods: {
        emptyCart() {
            Cart.dispatch('emptyCart').then((response) => {
                console.log(response);
            }, (error) => {
                console.log(error);
            });
        }
    }
})
</script>

<template>
    <div class="flex mx-4 justify-between my-2">
        <h1 class="mx-4 font-bold">Cart</h1>
        <router-link class="btn btn-blue" to="products">View Products</router-link>
    </div>
    <div class="p-8 flex border-2 mx-4 rounded-[2rem] justify-between" v-for="product in cart.state.products">
        <div>
            <div>
                <img :src="'images/test/products/' + product.image_url" width="150" />
            </div>
            <div class="pl-5">
                {{product.name}}
            </div>
        </div>
        <div>
            <default-quantity-control v-model="product.quantity"></default-quantity-control>
        </div>
    </div>
    <div class="px-8 py-2">
            <button class="btn-primary" @click="emptyCart">Empty Cart</button>
    </div>

</template>

<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

</style>
