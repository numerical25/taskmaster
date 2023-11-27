<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Header"
})
</script>

<template>
    <div class="flex px-4 py-2 overflow-y-auto border-bottom-2 border-primary bg-primary-reverse">
        <router-link to="/">
            <h1 class="text-2xl font-bold text-primary" style="font-family: 'MyFont',serif;">
                The Social Machine.<span>tech</span> ADMIN
            </h1>
        </router-link>
    </div>
</template>

<style scoped>

</style>
