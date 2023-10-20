<script>
import {defineComponent} from 'vue'
import {API_ENDPOINT} from "../../constants.js";
import axios from 'axios';
import {Cart} from "../../store/Cart.js";
import Product from "../../models/Product.js";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";
export default defineComponent({
    name: "Products",
    components: {DefaultQuantityControl},
    mounted() {
        console.log(this.products_url);
        axios.get(this.products_url).then((response) => {
            this.products = response.data.data.map(productData => new Product(productData));
        });
    },
    data() {
        return {
            cart: Cart,
            products_url: `${API_ENDPOINT}products`,
            products: [],
            USDollar : new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            })
        }
    },
    methods: {
        formatCurrency(value) {
            return this.USDollar.format(value);
        },
        addToCart(product) {
            Cart.dispatch('addToCart', product).then((response) => {
            }, (error) => {
                console.log("Error", error);
            });
        }
    }
})
</script>

<template>
    <div class="flex justify-between pt-4 px-5">
        <div>{{cart.state.products.length}}</div>
        <div class="flex">
            <router-link class="btn-primary mr-3" to="task">View Tasks</router-link>
            <router-link class="btn-primary" to="cart">View Cart</router-link>
        </div>
    </div>
    <div v-for="product in products" class="p-5 flex">
        <div>
            <img :src="'images/test/products/' + product.image_url" width="150" />
        </div>
        <div class="pl-5 flex justify-between w-full">
            <div>
                <div>
                    <b>{{product.name}}</b>
                </div>
                <div>
                    {{formatCurrency(product.price)}}
                </div>
                <div>
                    {{product.description}}
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <button class="btn-primary" @click="addToCart(product)">Add To Cart</button>
                <default-quantity-control class="mt-3" v-model="product.quantity"></default-quantity-control>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
