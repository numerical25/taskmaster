<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "TaskList",
    props: {
        records: {
            required: true,
            type: Array,
        }
    }
})
</script>

<template>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class=" py-2 text-emerald-600 text-left">Title</th>
            <th class=" py-2 text-emerald-600">Priority</th>
            <th class=" py-2 text-emerald-600">Priority Order</th>
            <th class=" py-2 text-emerald-600">Action</th>
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
            <td class="text-center flex justify-center">
                <button @click="openModal(record.id)"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
            focus:outline-none focus:ring-blue-300 font-medium rounded-lg mr-4
            text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Delete
                </button>
                <router-link :to="{ name: 'task-edit', params: { id: record.id } }">
                    <button
                        class="g-blue-500 bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                </router-link>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
