<script>
import {defineComponent} from 'vue'
import ApiService from "../../services/ApiService.ts";
import {useRoute} from "vue-router";
import Product from "../../models/Product.ts";
import Image from 'primevue/image'
import ImageService from "../../services/ImageService.ts";
import CartService from "../../services/CartService.ts";
import Button from "primevue/button";
import Rating from "primevue/rating";
import DefaultQuantityControl from "../../components/controls/quantity-box/DefaultQuantityControl.vue";
import RelatedProduct from "../../components/store/product/RelatedProduct.vue";

export default defineComponent({
    name: "View",
    mounted() {
        this.loadProduct();
    },
    data() {
        return {
            product: new Product(),
            apiService: new ApiService(),
            imageService: new ImageService(),
            cartService: new CartService(),
            productId: useRoute().params.id,
            route: useRoute(),
        }
    },
    methods: {
      loadProduct() {
          const productId = this.route.params.id;
          this.apiService.newGet(`products/${productId}/detail`).subscribe((response) => {
              this.product = response.data;
              this.product.quantity = 1;
          });
      }
    },
    watch: {
        '$route'() {
            // This will be called whenever the route changes
            this.loadProduct(); // Replace with the function that loads your data
        },
    },
    components: {Image, Button, DefaultQuantityControl, Rating, RelatedProduct}
})
</script>

<template>
    <div class="px-4 mb-5">
        <h1 class="font-bold text-6xl mb-3 text-primary">{{product.name}}</h1>
        <router-link class="font-bold pi pi-backward" :to="{name: 'products'}">
            <span class="pl-2">Back</span>
        </router-link>
        <div class="flex justify-between">
            <div class="col-6 pl-0">
                <div>
                    <Image :src="imageService.product_url(product.image_url)" width="450" preview />
                </div>
                <div class="flex">
                    <span class="mr-4 font-bold">Rating:</span><Rating v-model="product.rating" :cancel="false" />
                </div>
            </div>
            <div class="col-6">
                <h1 class="text-4xl py-2 text-primary">Product Details</h1>
                <div class="description">
                    <p class="font-bold py-2 text-color-secondary">Description</p>
                    <p>{{product.description}}</p>
                    <p class="py-2"><span class="font-bold text-color-secondary">Price: </span> {{cartService.formatCurrency(product.price)}}</p>
                    <div class="py-2 col-3">
                        <Button label="Add to Cart" class="w-full" icon="pi pi-cart-plus" @click="cartService.addToCart(product)" />
                        <default-quantity-control class="mt-3"
                                                  v-model="product.quantity"></default-quantity-control>
                    </div>
                </div>
            </div>
        </div>
        <RelatedProduct :related_products="product.related_product"></RelatedProduct>
    </div>
</template>

<style scoped>

</style>
