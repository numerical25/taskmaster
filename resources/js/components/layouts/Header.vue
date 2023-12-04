<script lang="ts">
import {defineComponent} from 'vue'
import SideBar from "./SideBar.vue";
import Button from "primevue/button";

export default defineComponent({
    name: "Header",
    methods: {
        toggle() {
            this.visible = !this.visible;
        },
    },
    data() {
        return {
            visible: false,
        }
    },
    components: {SideBar, Button}
})
</script>

<template>
    <SideBar :visible="visible" @toggle="toggle"></SideBar>
    <div class="flex px-8 py-2 overflow-y-auto justify-center border-bottom-2 border-primary bg-primary-reverse">
        <Button icon="pi pi-list" label="Menu" @click="toggle" class="mr-3" />
        <router-link to="/">
            <h1 class="text-5xl font-bold text-primary" style="font-family: 'MyFont',serif;">
                The Social Machine.<span>tech</span>
            </h1>
        </router-link>
    </div>
</template>

<style scoped>

</style>
