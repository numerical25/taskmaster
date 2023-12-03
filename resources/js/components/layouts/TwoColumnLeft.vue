<script lang="ts">
import {defineComponent} from 'vue'
import Products from "../../views/products/Products.vue";

export default defineComponent({
    name: "TwoColumnLeft",
    components: {Products}
})
</script>

<template>
<div class="px-4 grid">
    <div class="col-3">
        Left Column
    </div>
    <div class="col-9">
        Main Content
    </div>
</div>
</template>

<style scoped>

</style>
