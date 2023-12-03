<script>
import {defineComponent, ref} from 'vue'
import {Cart} from "../../store/Cart.ts";
import Product from "../../models/Product.ts";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";
import ApiService from "../../services/ApiService.ts";
import { ShoppingCartIcon } from "@heroicons/vue/24/solid/index.js";
import {toast} from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import Button from "primevue/button";
import Image from "primevue/image";
import Paginator from "primevue/paginator";
import PaginationData from "../../models/PaginationData.ts";
import CartService from "../../services/CartService.ts";
import StoreNav from "../../components/layouts/store/StoreNav.vue";
export default defineComponent({
    name: "Products",
    components: {StoreNav, ShoppingCartIcon, DefaultQuantityControl, Button, Image, Paginator},
    mounted() {
        this.paginator = ref('paginator');
        this.apiService.get('products').subscribe((response) => {
            toast("Products Loaded", {
                autoClose: 1000,
            }); // ToastOptions
            this.paginationData = response.data;
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
            apiService: new ApiService(),
            paginator: {},
            currentPage: Number(0),
            paginationData: new PaginationData(),
            cartService: new CartService()
        }
    },
    methods: {
        page(event) {
            this.apiService.get('products?page='+(Number(this.currentPage) + 1)).subscribe((response) => {
                toast("Products Loaded", {
                    autoClose: 1000,
                }); // ToastOptions
                this.products = response.data.data.map(productData => new Product(productData));
            });
        }
    },
})
</script>

<template>
    <StoreNav/>
    <div class="flex justify-center">
        <Paginator ref="paginator" v-model:first="currentPage" @page="page($event)" :rows="1"
                   :totalRecords="paginationData.last_page" :rowsPerPageOptions="[10, 20, 30]"></Paginator>
    </div>
    <div v-for="product in products" class="p-5 flex">
        <div>
            <router-link :to="{name: 'product-details',params: {id: product.id}}">
                <Image :src="'images/test/products/' + product.image_url" width="150"  />
            </router-link>
        </div>
        <div class="pl-5 flex justify-between w-full">
            <div>
                <div>
                    <router-link :to="{name: 'product-details', params: {id: product.id}}">
                        <b>{{product.name}}</b>
                    </router-link>
                </div>
                <div>
                    {{cartService.formatCurrency(product.price)}}
                </div>
                <div>
                    {{product.description}}
                </div>
            </div>
            <div class="flex flex-col justify-center w-44">
                <Button label="Add to Cart" icon="pi pi-cart-plus" @click="cartService.addToCart(product)" />
                <default-quantity-control class="mt-3" v-model="product.quantity"></default-quantity-control>
            </div>
        </div>
    </div>
    <div class="flex justify-center mb-4">
        <Paginator ref="paginator" v-model:first="currentPage" @page="page($event)" :rows="1"
                   :totalRecords="paginationData.last_page" :rowsPerPageOptions="[10, 20, 30]"></Paginator>
    </div>
</template>

<style scoped>

</style>
