<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../services/ApiService";
import {useRoute} from "vue-router";
import Blog from "../../models/Blog";
import Button from "primevue/button";

export default defineComponent({
    name: "View",
    data() {
        return {
            apiService: new ApiService(),
            blogData: new Blog(),
            route: useRoute(),
        }
    },
    mounted() {
        const blogId = this.route.params.id;
        this.apiService.get(`/blog/${blogId}/view`).subscribe((response: Blog) => {
           this.blogData = response.data;
        });
    },
    components: {Button}
})
</script>

<template>
<div class="p-4">
    <div class="flex items-center justify-between">
        <h1 class="text-4xl font-bold">{{blogData.title}}</h1>
        <router-link :to="{name: 'blog'}"><Button label="Back" class="mr-5" /></router-link>
    </div>
    <p class="pb-5"><span class="font-bold">
        Published by</span> {{blogData.owner.name}} <br/>
        <span class="font-bold">Date:</span> {{ blogData.created_at}}
    </p>
    <p>{{blogData.content}}</p>
</div>
</template>

<style scoped>

</style>
