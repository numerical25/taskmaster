<script>
import {defineComponent} from 'vue'
import {Cart} from "../../store/Cart.js";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";
import {TrashIcon} from "@heroicons/vue/20/solid/index.js";
export default defineComponent({
    name: "Cart",
    components: {DefaultQuantityControl, TrashIcon},
    data() {
        return {
            cart: Cart,
            total: 0,
            USDollar : new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            }),
        }
    },
    created() {
        this.cart.state.products.forEach((product) => {
            this.total += product.price;
        });
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
    <div class="p-8 flex border-2 mx-4 mt-4 rounded-[2rem] justify-between" v-for="product in cart.state.products">
        <div>
            <div>
                <img :src="'images/test/products/' + product.image_url" width="150" />
            </div>
            <div class="pl-5">
                {{product.name}}
                {{USDollar.format(product.price)}}
            </div>
        </div>
        <div class="w-44 flex flex-col items-center">
            <default-quantity-control v-model="product.quantity"></default-quantity-control>
            <div class="w-full flex justify-center mt-3 ">
                <button class="btn-red w-full flex items-center justify-between">
                    <span class="ml-8">Delete</span>
                    <TrashIcon class="w-4 h-4"></TrashIcon>
                </button>
            </div>
        </div>
    </div>
    <div class="px-8">
        <b>Total:</b> {{ USDollar.format(total)}}
    </div>
    <div class="px-8 py-2">
            <button class="btn-primary" @click="emptyCart">Empty Cart</button>
            <router-link :to="{name: 'checkout'}" class="btn-primary ml-5">Checkout</router-link>
    </div>
</template>

<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

</style>
