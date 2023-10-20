<template>
        <div class="flex justify-between px-5 pb-8 pt-4">
            <h1 class="text-4xl font-bold">Tasks</h1>
            <div class="flex">
                <router-link class="btn btn-blue mr-3" :to="{ name: 'products' }">
                    View Products
                </router-link>
                <router-link class="btn btn-blue" :to="{ name: 'task-create' }">
                    Create Task
                </router-link>
            </div>
        </div>
        <div class="rounded-t-xl overflow-hidden p-8">
            <task-list :records="records"></task-list>
        </div>
        <pagination :from-prop="apiService.data.from" :to-prop="apiService.data.to" :total-prop="apiService.data.total"
                    :on-back="handleBack" :on-next="handleNext"
                    ref="pagination"></pagination>
        <prompt-delete-task ref="promptDelete"></prompt-delete-task>
</template>
<script>
import axios from 'axios';
import { Modal } from 'flowbite';
import {API_ENDPOINT} from "../../constants.js"
import PromptDeleteTask from "../../modals/PromptDeleteTask.vue";
import Pagination from "../../components/Pagination.vue";
import TaskList from "../../components/lists/TaskList.vue";
import ApiService from "../../services/ApiService.js";
import 'vue3-toastify/dist/index.css';
import {toast} from "vue3-toastify";
export default {
    mounted() {
        const element = this.$refs.modal;
        this.deleteModal = this.$refs.promptDelete;
        this.deleteModal.onAfterDelete(() => {
           this.getTasks('tasks');
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
            apiService: new ApiService()
        };
    },
    created() {
        this.getTasks('tasks');
    },
    methods: {
        handleNext() {
            this.apiService.next().then((response) => {
                this.records = response.data.data;
            }, (error) => {
                toast(error, {
                    autoClose: 1000,
                }); // ToastOptions
            });
        },
        handleBack() {
            this.apiService.back().then((response) => {
                this.records = response.data.data;
            }, (error) => {
                toast(error, {
                    autoClose: 1000,
                }); // ToastOptions
            });
        },
        openModal(id) {
            this.deleteModal.openModal(id);
        },
        closeModal() {
            this.selectedId = null;
            this.modal.hide();
        },
        getTasks(url = null) {
            this.apiService.get(url).then((response) => {
                this.records = response.data.data;
            });
        },
        onDragStart(event ,index) {
            event.dataTransfer.setData('text/plain', index);
        },
        onDragOver(event) {
            event.preventDefault();
        },
        onDrop(event, newIndex) {
            event.preventDefault();
            const draggedIndex = event.dataTransfer.getData('text/plain');
            if (draggedIndex !== '') {
                const draggedTask = this.records[draggedIndex];
                const originalDraggedOrder = draggedTask.priority_order;

                const droppedTask = this.records[newIndex];
                draggedTask.priority_order = droppedTask.priority_order;
                droppedTask.priority_order = originalDraggedOrder;

                axios.post(`${API_ENDPOINT}tasks/${draggedTask.id}/update`, draggedTask);
                axios.post(`${API_ENDPOINT}tasks/${droppedTask.id}/update`, droppedTask);

                this.records[newIndex] = draggedTask;
                this.records[draggedIndex] = droppedTask;
            }
        }
    },
    components : {
        PromptDeleteTask,
        Pagination,
        TaskList
    }
};
</script>
