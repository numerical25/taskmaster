<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../services/ApiService";

export default defineComponent({
    name: "Latest",
    data() {
        return {
            latestComments: [],
            apiService: new ApiService()
        }
    },
    mounted() {
        this.apiService.get('comment/latest').subscribe((response) => {
            console.log(response);
        });
    }
})
</script>

<template>
Latest Comments
</template>

<style scoped>

</style>
