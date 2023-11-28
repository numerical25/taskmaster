<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../../services/ApiService";
import TreeTable from "primevue/treetable";
import Column from "primevue/column";
import Card from "primevue/card";
import Button from "primevue/button";
import AutoComplete from "primevue/autocomplete";

export default defineComponent({
    components: {TreeTable, Column, Card, Button, AutoComplete},
    name: "Create",
    data() {
        return {
            apiService: new ApiService(),
            categories: []
        }
    },
    mounted() {
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
    }
})
</script>

<template>
    <div class="p-4">
        <Card class="bg-primary">
            <template #header>
                <div class="flex justify-between">
                    <h1 class="font-bold pl-4 pt-3">Site Categories</h1>
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
