<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Header"
})
</script>

<template>
    <div class="flex px-8 py-2 overflow-y-auto justify-center border-bottom-2 border-primary bg-white">
        <router-link to="/">
            <h1 class="text-5xl font-bold text-primary" style="font-family: 'MyFont',serif;">
                The Social Machine.<span>tech</span>
            </h1>
        </router-link>
    </div>
</template>

<style scoped>

</style>
