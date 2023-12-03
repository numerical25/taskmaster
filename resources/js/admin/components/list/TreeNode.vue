<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "TreeNode",
    emits: ['onShowState'],
    setup(props, {emit}) {
        const onShowState = () => {
            this.showState = !this.showState;
            emit('onShowState', this.showState);
        }
        return {onShowState}
    },
    props: {
        label: {
            type: String,
            required: true
        },
        show: {
            type: Boolean,
            required: false,
        }
    },
    data() {
        return {
            showState: false,
        }
    }
})
</script>

<template>
{{$props.label}}
</template>

<style scoped>

</style>
