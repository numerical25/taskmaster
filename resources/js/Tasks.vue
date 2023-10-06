<template>
        <div class="flex justify-between p-8">
            <h1 class="text-4xl font-bold">Tasks</h1>
            <router-link :to="{ name: 'task-create' }">
                <button class="dark:bg-blue-600 rounded font-bold py-2 px-5 text-white">Create Task</button>
            </router-link>
        </div>
        <div class="rounded-t-xl overflow-hidden p-8">
            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th class=" py-2 text-emerald-600 text-left">Title</th>
                    <th class=" py-2 text-emerald-600">Priority</th>
                    <th class=" py-2 text-emerald-600">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="record in records">
                    <td class=""> {{ record.name }}</td>
                    <td class="text-center"> {{ record.priority }}</td>
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
        </div>
        <pagination ref="pagination"></pagination>
        <prompt-delete-task ref="promptDelete"></prompt-delete-task>
</template>
<script>
import axios from 'axios';
import { Modal } from 'flowbite';
import * as constants from "constants";
import {API_ENDPOINT} from "./constants.js";
import PromptDeleteTask from "./modals/PromptDeleteTask.vue";
import Pagination from "./components/Pagination.vue";
export default {
    mounted() {
        const element = this.$refs.modal;
        this.deleteModal = this.$refs.promptDelete;
        this.$refs.pagination.onNext(() => {
            if(this.nextPageUrl)
                this.getTasks(this.nextPageUrl)
        });
        this.$refs.pagination.onBack(() => {
            if(this.lastPageUrl)
                this.getTasks(this.lastPageUrl);
        });
        this.pagination = this.$refs.pagination;
        this.deleteModal.onAfterDelete(() => {
           this.getTasks();
        });
        // options with default values
        const options = {
            placement: 'center-center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {
                console.log('modal is hidden');
            },
            onShow: () => {
                console.log('modal is shown');
            },
            onToggle: () => {
                console.log('modal has been toggled');
            }
        };
        this.modal = new Modal(element, options);
    },
    data() {
        return {
            selectedId: null,
            records: null,
            modal: Modal,
            deleteModal: PromptDeleteTask,
            pagination: Pagination,
            nextPageUrl: '',
            lastPageUrl: ''
        };
    },
    created() {
        this.getTasks();
    },
    methods: {
        openModal(id) {
            this.deleteModal.openModal(id);
        },
        closeModal() {
            this.selectedId = null;
            this.modal.hide();
        },
        getTasks(url = null) {
            let pageUrl = `${API_ENDPOINT}tasks`;
            if(url) {
                pageUrl = url;
            }
            axios.get(pageUrl).then((response) => {
                this.records = response.data.data;
                this.nextPageUrl = response.data.next_page_url;
                this.lastPageUrl = response.data.prev_page_url;
                this.pagination.from = response.data.from;
                this.pagination.to = response.data.to;
                this.pagination.total = response.data.total;
            });
        }
    },
    components : {
        PromptDeleteTask,
        Pagination
    }
};
</script>
