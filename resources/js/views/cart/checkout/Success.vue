<script lang="ts">
import {defineComponent} from "vue";
import Button from "primevue/button";

export default defineComponent({
    components: {Button}
});
</script>

<template>
    <div class="flex justify-center h-full items-center">
        <div class="flex-row items-center">
            <h1><span class="text-5xl">Payment Success!</span></h1>
            <router-link :to="{name: 'store'}">
                <Button label="Go To Store" class="w-full mt-5"/>
            </router-link>
        </div>
    </div>
</template>

<style scoped>

</style>
