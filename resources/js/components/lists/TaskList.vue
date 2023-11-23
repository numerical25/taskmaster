<script>
import {defineComponent} from 'vue'
import Button from "primevue/button";

export default defineComponent({
    name: "TaskList",
    props: {
        records: {
            required: true,
            type: Array,
        }
    },
    components: {Button}
})
</script>

<template>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class=" py-2 text-primary text-left">Title</th>
            <th class=" py-2 text-primary">Priority</th>
            <th class=" py-2 text-primary">Priority Order</th>
            <th class=" py-2 text-primary">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(record, index) in records" :key="index" draggable="true"
            @dragstart="onDragStart($event, index)"
            @dragover="onDragOver($event)"
            @drop="onDrop($event, index)">
            <td class=""> {{ record.name }}</td>
            <td class="text-center"> {{ record.priority }}</td>
            <td class="text-center"> {{ record.priority_order }}</td>
            <td class="text-center flex justify-end">
                <Button icon="pi pi-trash" @click="openModal(record.id)"
                        class="mr-2" type="button" label="Delete" />
                <router-link :to="{ name: 'task-edit', params: { id: record.id } }">
                    <Button label="Edit" icon="pi pi-file-edit"></Button>
                </router-link>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
