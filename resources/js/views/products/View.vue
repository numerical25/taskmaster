<script>
import {defineComponent} from 'vue'
import {ShoppingCartIcon} from "@heroicons/vue/24/solid/index.js";
import ApiService from "../../services/ApiService.ts";
import {useRoute} from "vue-router";
import Product from "../../models/Product.ts";
import Image from 'primevue/image'
import ImageService from "../../services/ImageService.ts";
import CartService from "../../services/CartService.ts";
import Button from "primevue/button";
import Rating from "primevue/rating";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";

export default defineComponent({
    name: "View",
    mounted() {
        console.log(this.apiService);
        console.log(useRoute().params.id);
        const productId = useRoute().params.id;
        this.apiService.newGet(`products/${productId}/detail`).subscribe((response) => {
            this.product = response.data;
            this.product.quantity = 1;
        });
    },
    data() {
        return {
            product: new Product(),
            apiService: new ApiService(),
            imageService: new ImageService(),
            cartService: new CartService(),
        }
    },
    components: {Image, Button, DefaultQuantityControl, Rating}
})
</script>

<template>
    <div class="px-4 mb-5">
        <h1 class="font-bold text-6xl mb-3">{{product.name}}</h1>
        <router-link class="font-bold pi pi-backward" :to="{name: 'products'}">
            <span class="pl-2">Back</span>
        </router-link>
        <div class="flex justify-between">
            <div class="col-6 pl-0">
                <div>
                    <Image :src="imageService.product_url(product.image_url)" width="450" preview />
                </div>
                <div>
                    <span>Rating:</span><Rating v-model="product.rating" :cancel="false" />
                </div>
            </div>
            <div class="col-6">
                <h1 class="text-4xl py-2">Product Details</h1>
                <div class="description">
                    <p class="font-bold py-2">Description</p>
                    <p>{{product.description}}</p>
                    <p class="py-2"><span class="font-bold">Price: </span> {{product.price}}</p>
                    <div class="py-2 col-3">
                        <Button label="Add to Cart" class="w-full" icon="pi pi-cart-plus" @click="cartService.addToCart(product)" />
                        <default-quantity-control class="mt-3"
                                                  v-model="product.quantity"></default-quantity-control>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
