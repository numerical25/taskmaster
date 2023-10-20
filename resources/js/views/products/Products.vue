<script>
import {defineComponent} from 'vue'
import {Cart} from "../../store/Cart.js";
import Product from "../../models/Product.js";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";
import ApiService from "../../services/ApiService.js";
import { ShoppingCartIcon } from "@heroicons/vue/24/solid/index.js";
import {toast} from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
export default defineComponent({
    name: "Products",
    components: {ShoppingCartIcon, DefaultQuantityControl},
    mounted() {
        this.apiService.get('products').then((response) => {
            toast("Products Loaded", {
                autoClose: 1000,
            }); // ToastOptions
            this.products = response.data.data.map(productData => new Product(productData));
        });
    },
    data() {
        return {
            cart: Cart,
            products: [],
            USDollar : new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            }),
            apiService: new ApiService()
        }
    },
    methods: {
        formatCurrency(value) {
            return this.USDollar.format(value);
        },
        addToCart(product) {
            Cart.dispatch('addToCart', product).then((response) => {
                toast(response, {
                    autoClose: 1000,
                }); // ToastOptions
            }, (error) => {
                toast(error, {
                    autoClose: 1000,
                }); // ToastOptions
            });
        }
    },
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
                    <router-link :to="{name: 'product-details', params: {id: product.id}}">
                        <b>{{product.name}}</b>
                    </router-link>
                </div>
                <div>
                    {{formatCurrency(product.price)}}
                </div>
                <div>
                    {{product.description}}
                </div>
            </div>
            <div class="flex flex-col justify-center w-44">
                <button class="btn-primary flex items-center " @click="addToCart(product)">
                    <ShoppingCartIcon class="h-5 w-5 text-white mr-4" />
                    Add To Cart</button>
                <default-quantity-control class="mt-3" v-model="product.quantity"></default-quantity-control>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>