<script lang="ts">
import {defineComponent} from 'vue'
import ApiService from "../../services/ApiService";

export default defineComponent({
    name: "BlogComment",
    props: {
        content_id: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            apiService: new ApiService(),
            comments: []
        }
    },
    mounted() {
        this.apiService.get(`comment/${this.$props.content_id}/list`)
            .subscribe((response) => {
            console.log(response);
        });
    }
})
</script>

<template>

</template>

<style scoped>

</style>
