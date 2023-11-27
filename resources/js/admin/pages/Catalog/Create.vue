<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../../services/ApiService";
import TreeTable from "primevue/treetable";
import Column from "primevue/column";
import Card from "primevue/card";
import TreeNodeService from "../../../services/TreeNodeService";

export default defineComponent({
    components: {TreeTable, Column, Card},
    name: "Create",
    data() {
        return {
            apiService: new ApiService(),
            categories: []
        }
    },
    mounted() {
        this.apiService.get('category').subscribe(response => {
            response.data.forEach(item => {
                this.categories.push(new TreeNodeService(item.id, item.name, item.name,'', item.children));
            });
        });
    }
})
</script>

<template>
    <div class="px-4">
        {{categories}}
        <Card class="bg-primary">
            <template #header>
                Create new Catalog
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
