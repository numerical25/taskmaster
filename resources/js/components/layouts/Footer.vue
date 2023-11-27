<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Footer"
})
</script>

<template>
    <footer class="p-4 bg-primary ">
        <ul>
            <li class="underline"><router-link to="">About Us</router-link></li>
            <li class="underline">Contact Us</li>
        </ul>
    </footer>
</template>

<style scoped>

</style>
