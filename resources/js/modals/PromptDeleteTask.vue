<script>
    import {Modal} from "flowbite";
    import axios from "axios";
    import {API_ENDPOINT} from "../constants.ts";

    export default {
        mounted() {
            const element = this.$refs.modal;
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
                modal: Modal,
                callback: null
            }
        },
        methods: {
            openModal(id) {
                this.selectedId = id;
                this.modal.show();
            },
            closeModal() {
                this.selectedId = null;
                this.modal.hide();
            },
            deleteTask() {
                axios.delete(`${API_ENDPOINT}tasks/${this.selectedId}/delete`).then((response) => {
                    this.modal.hide();
                    this.selectedId = null;
                    if(this.callback) {
                        this.callback();
                    }
                })
            },
            onAfterDelete(callback = null) {
                this.callback = callback;
            }
        }
    }
</script>

<template>
    <div tabindex="-1" ref="modal"
         class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button @click="closeModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this task?</h3>
                    <button @click="deleteTask"  type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button  type="button" @click="closeModal"
                             class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border
                            border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10
                            dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white
                            dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
