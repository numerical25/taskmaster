<script lang="ts">
import {defineComponent} from 'vue'
import ImageService from "../../../services/ImageService";
import Image from "primevue/image";
export default defineComponent({
    name: "RelatedProduct",
    props: {
        related_products: {
            required: true,
            type: Array,
        }
    },
    data() {
        return {
            imageService: new ImageService(),
        }
    },
    components: {Image}
})
</script>

<template>
    <h1 class="text-4xl"> Related Products </h1>
    <div class="flex">
        <div  v-for="item in related_products" class="mr-3 flex-row justify-center items-center col-2">
            <router-link class="flex-row items-center justify-center w-full block"
                         :to="{name: 'product-details', params: {id: item.related.id}}">
                <span class="w-full block font-bold text-center">{{item.related.name}}</span>
                <Image class="justify-center flex" :src="imageService.product_url(item.related.image_url)" />
            </router-link>
            <router-link class="flex justify-center w-full block"
                         :to="{name: 'product-details', params: {id: item.related.id}}">
                <Button label="View" class="mt-2 w-full"></Button>
            </router-link>
        </div>
    </div>
</template>

<style scoped>

</style>
