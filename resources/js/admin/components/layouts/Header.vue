<script lang="ts">
import {defineComponent} from 'vue'
import Button from "primevue/button";
import Sidebar from "./SideBar.vue";

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
    components: {Button, Sidebar}
})
</script>

<template>
    <Sidebar :visible="visible" @toggle="toggle"></Sidebar>
    <div class="flex px-4 py-2 items-center
        overflow-y-auto border-bottom-2 border-primary bg-primary-reverse">
        <Button icon="pi pi-list" label="Menu" @click="toggle" class="mr-3" />
        <router-link to="/">
            <h1 class="text-2xl font-bold text-primary" style="font-family: 'MyFont',serif;">
                The Social Machine.<span>tech</span> ADMIN
            </h1>
        </router-link>
    </div>
</template>

<style scoped>

</style>
