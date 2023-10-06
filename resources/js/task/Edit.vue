<template>
    <div class="bg-gradient-to-r from-emerald-50 to-teal-100">
        <div class="flex p-8">
            <router-link :to="{ name: 'task'}">
                <button
                    class="g-blue-500 bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</button>
            </router-link>
        </div>
        <h1 class="pl-8 text-4xl font-bold">Tasks </h1>
        <div class="rounded-t-xl overflow-hidden p-8 w-100">
            <div class="sm:col-span-12">
                <label for="name" class="block text-sm font-bold leading-6 text-gray-900">ID</label>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" name="id" id="id" v-model="record.id" readonly autocomplete="name"
                               class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900
                               placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                    </div>
                </div>
            </div>
            <div class="sm:col-span-12">
                <label for="name" class="block text-sm font-bold leading-6 text-gray-900">Priority</label>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <select name="priority" id="priority" v-model="record.priority"
                               class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900
                               placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                            <option v-for="priority in priorities" :value="priority" :key="priority">{{priority}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-12">
                <label for="name" class="block text-sm font-bold leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" v-model="record.name" name="name" id="name" autocomplete="name"
                               class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900
                               placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                    </div>
                </div>
            </div>
            <div class="sm:col-span-12">
                <button @click="save" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </div>
    </div>
</template>
<script>
import {useRoute, useRouter} from "vue-router";
import axios from "axios";
import {API_ENDPOINT} from "../constants.js";
export default {
    data() {
      return {
          name: '',
          id: '',
          record: {
              priority: ''
          },
          router: null,
          priorities: [
              'High',
              'Medium',
              'Low'
          ]
      }
    },
    async created() {
        let router = useRouter();
        this.router = router;
        const route = useRoute();
        axios.get(`${API_ENDPOINT}tasks/${route.params.id}`).then((response) => {
            if(response.data) {
                this.record = response.data;
            }
        });
        this.id = route.params.id;
    },
    methods: {
        save() {
            axios.post(`${API_ENDPOINT}tasks/${this.record.id}/update`, this.record).then((response) => {
                console.log('Data Saved', response);
                this.router.push('/task');
            });
        }
    }
};
</script>
