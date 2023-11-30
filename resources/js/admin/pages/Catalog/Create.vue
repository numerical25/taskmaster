<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../../services/ApiService";
import TreeTable from "primevue/treetable";
import Column from "primevue/column";
import Card from "primevue/card";
import Button from "primevue/button";
import AutoComplete from "primevue/autocomplete";
import Sidebar from "../../components/layouts/SideBar.vue";
import DataTable from "primevue/datatable";

export default defineComponent({
    components: {TreeTable, Column, Card, Button, AutoComplete, Sidebar, DataTable},
    name: "Create",
    data() {
        return {
            apiService: new ApiService(),
            categories: [],
            siteCategories: [],
            items: [],
            newCategory: '',
            visible: false,
            columns: null,
        }
    },
    created() {
        this.columns = [
            {field: 'name', header: 'Name'},
            {field: 'created_at', header: 'Created At'},
        ];
    },
    mounted() {
        this.apiService.get('site-category').subscribe(response => {
           console.log(response);
           const cats = [];
           response.data.forEach(item => {
                cats.push({
                    name: item.child.name,
                    created_at: item.created_at
                });
           });
           this.siteCategories = cats;
        });
        this.apiService.get('category').subscribe(response => {
            const cats = [];
            response.data.forEach(item => {
                cats.push({
                    key: item.id,
                    data: {
                        name: item.name,
                        created_at: item.created_at
                    }
                });
            });
            this.categories = cats;
        });
    },
    methods: {
        onColReorder() {
        },
        onRowReorder(event) {
            this.siteCategories = event.value;
        },
        searchCategories(event) {
            const params = {'name' : event.query};
            this.apiService.get('category/search', {params}).subscribe(response => {
               console.log(response);
               this.items = response.data;
            });
        },
        addCategory() {
            const data = { name: (!this.newCategory.id ? this.newCategory : this.newCategory.name) };
            this.apiService
                .post('category/create', data)
                .subscribe(response => {
                    const cats = [];
                    response.data.forEach(item => {
                        cats.push({
                            key: item.id,
                            data: {
                                name: item.name,
                                created_at: item.created_at
                            }
                        });
                    });
                    this.categories = cats;
                });
        },
    }
})
</script>

<template>
    <div class="p-4">
        <div class="p-3 flex">
            <div class="flex-row">
               <span class="p-float-label">
                <AutoComplete class="bg-primary-reverse "
                              option-label="name"
                              :suggestions="items"
                              input-id="category"
                              v-model="newCategory" @complete="searchCategories"></AutoComplete>
                   <label for="category">Add Category</label>
               </span>
                {{newCategory.id}}
            </div>
            <div class="pl-2">
                <Button label="Add" @click="addCategory"></Button>
            </div>
        </div>
        <Card class="bg-primary">
            <template #header>
                <div class="flex justify-between">
                    <h1 class="font-bold pl-4 pt-3">Site Categories</h1>
                    <Button class="bg-green-800 hover:bg-green-600" label="Create Category" />
                </div>
            </template>
            <template #content>
                <DataTable :value="siteCategories" @rowReorder="onRowReorder">
                    <Column expander style="width: 5rem" />
                    <Column rowReorder headerStyle="width: 3rem" :reorderableColumn="false" />
                    <Column field="name" header="Name" ></Column>
                    <Column field="created_at" header="Created At"></Column>
                </DataTable>
            </template>
        </Card>
        <Card class="bg-primary">
            <template #header>
                <div class="flex justify-between">
                    <h1 class="font-bold pl-4 pt-3">Global Categories</h1>
                    <Button class="bg-green-800 hover:bg-green-600" label="Create Category" />
                </div>
            </template>
            <template #content>
                <TreeTable :value="categories">
                    <Column field="name" header="Name" expander></Column>
                    <Column field="created_at" header="Created At"></Column>
                </TreeTable>
            </template>
        </Card>
    </div>
</template>

<style scoped>

</style>
