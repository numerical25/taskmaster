<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../services/ApiService";
import IPaginationResponse from "../../interfaces/PaginationResponse.interface";
import Blog from "../../models/Blog";
import Card from "primevue/card";
import Button from "primevue/button";
import Paginator from "primevue/paginator";
import {toast} from "vue3-toastify";
import Product from "../../models/Product";

export default defineComponent({
    name: "Blog",
    data() {
        return {
            apiService: new ApiService(),
            blogFeed: [],
            currentPage: 0
        }
    },
    mounted() {
        this.apiService.get('blog').subscribe((response : IPaginationResponse<Blog>) => {
            this.blogFeed = response;
        })
    },
    methods: {
        page(event) {
            this.apiService.get('blog?page='+(Number(this.currentPage) + 1)).subscribe((response) => {
                toast("Blog Feed Loaded", {
                    autoClose: 1000,
                }); // ToastOptions
                this.blogFeed = response;
            });
        },
    },
    components: {Card, Button , Paginator}
})
</script>

<template>
    <div class="mx-4 pt-4">
        <h1 class="text-4xl font-bold">Blog Feed</h1>
        <Paginator :totalRecords="blogFeed?.data?.last_page"  :rows="1"
                   v-model:first="currentPage" @page="page($event)"></Paginator>
        <Card v-for="blog in blogFeed?.data?.data" class="border-2 border-primary my-4">
            <template #header>
                <span class="pl-4 font-bold text-4xl">{{blog.title}}</span>
            </template>
            <template #content>
                <p>{{blog.content}}</p>
            </template>
            <template #footer>
                <router-link :to="{name: 'blog-view', params: {id: blog.id}}"><Button label="View Details" /></router-link>
            </template>
        </Card>
        <Paginator :totalRecords="blogFeed?.data?.last_page"  :rows="1"
                   v-model:first="currentPage" @page="page($event)" class="mb-4"></Paginator>
    </div>
</template>

<style scoped>

</style>
