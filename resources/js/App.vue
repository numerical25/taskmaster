<template>
    <div class="h-screen pb-10 overflow-y-auto">
        <div class="flex p-8 bg-green-800 overflow-y-auto">
            <h1 class="text-5xl font-bold text-white">Task Master</h1>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
import axios from 'axios';
import * as constants from "constants";
import {API_ENDPOINT} from "./constants.js";
import {createApp} from "vue";
import router from './routes.js';
export default {
    created() {
    },
    data() {
        return {
            message: 'Hello, world!',
        };
    },
};
</script>
