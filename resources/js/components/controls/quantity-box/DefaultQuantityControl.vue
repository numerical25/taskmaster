<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "DefaultQuantityControl",
    props: {
        modelValue: {
            type: Number,
            required: true,
        }
    },
    emits: ['update:modelValue'],
    methods: {
        increment() {
            this.$emit('update:modelValue', this.modelValue + 1);
        },
        decrement() {
            this.$emit('update:modelValue', this.modelValue - 1);
        }
    }
})
</script>

<template>
    <div class="flex flex-row w-44 h-10">
        <button  @click="decrement"
                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20
                rounded-l cursor-pointer outline-none">
            <span class="m-auto text-2xl font-thin">−</span>
        </button>
        <input type="number"  v-model="modelValue"
               class="text-box-primary text-center" name="quantity" />
        <button @click="increment"
                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full
                w-20 rounded-r cursor-pointer">
            <span class="m-auto text-2xl font-thin">+</span>
        </button>
    </div>
</template>

<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
