<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Pagination",
    data() {
        return {
            from: 0,
            to: 0,
            total: 0
        }
    },
    methods: {
        next() {
            if(this.onNext) {
                this.onNext();
            }
        },
        back() {
            if(this.onBack) {
                this.onBack();
            }
        }
    },
    props: {
        onNext: {
            type: Function,
            required: true,
        },
        onBack: {
            type: Function,
            required: true,
        }
    }
})
</script>

<template>

    <div class="flex flex-col items-center mb-10">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
      Showing <span class="font-semibold">{{from}}</span> to <span class="font-semibold">{{ to }}</span> of <span class="font-semibold">{{total}}</span> Entries
  </span>
        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            <button @click="back" class="flex items-center justify-center px-3 h-8 text-sm
                font-medium text-white rounded-l g-blue-500 bg-blue-700 text-white font-bold">
                Prev
            </button>
            <button @click="next" class="flex g-blue-500 bg-blue-700 text-white font-bold items-center justify-center px-3 h-8 text-sm font-medium  border-0 border-l border-gray-700 rounded-r ">
                Next
            </button>
        </div>
    </div>
</template>

<style>

</style>
