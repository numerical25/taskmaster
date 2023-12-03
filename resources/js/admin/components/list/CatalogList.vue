<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "CatalogList",
    props: {
        list: {
            type: Array,
            required: false
        },
        showList: {
            type: Boolean,
            required: false,
        },
        isChild: {
            type: Boolean,
            required: false,
        }
    },
    emits:['onDropEnd'],
    methods: {
        handleDragStart(event, node) {
            event.dataTransfer.setData('application/json', JSON.stringify(node));
        },
        handleDrop(event, targetNode) {
            event.preventDefault();

            let dragNode = JSON.parse(event.dataTransfer.getData('application/json'));
            // Determine the position: 'before', 'after', or 'inside'
            const rect = event.target.getBoundingClientRect();
            const offsetY = event.clientY - rect.top;
            const position = offsetY < rect.height / 2 ? 'before' : 'after';
            this.findAndRemoveNode(dragNode);
            // Find the index of the target node
            const targetIndex = this.list.findIndex((n) => n === targetNode);
            // If the position is 'inside' and the target node has children, add the dragNode as a child
            if (position === 'inside' && targetNode.children) {
                targetNode.children.push(dragNode);
            } else {
                // Otherwise, add the dragNode before or after the target node
                const insertIndex = position === 'before' ? targetIndex : targetIndex + 1;
                this.list.splice(insertIndex, 0, dragNode);
            }
            this.onDropEnd(event, dragNode);
        },
        toggleChildList(node) {
            node.show = !node.show;
        },
        allowDrop(event) {
            event.preventDefault();
        },
        findAndRemoveNode(dragNode) {
            this.list.forEach((item,index) => {
                if(item.key === dragNode.key) {
                    this.list.splice(index, 1);
                }
            });
        },
        handleDropEnd(event, node) {
            const originalIndex = this.list.findIndex((n) => n.key === node.key);
            if (originalIndex !== -1) {
                this.list.splice(originalIndex, 1);
                event.stopImmediatePropagation();
            }
            this.onDropEnd(event,node);
        }
    },
    setup(props, {emit}) {
        const onDropEnd = (event ,node) => {
            emit('onDropEnd', event, node);
        };
        return {onDropEnd};
    },
    data() {
        return {
            showChildList: false
        }
    },
});
</script>

<template>
    <ul v-if="list.length" :class="{'pl-5' : $props.isChild}">
        <li v-for="node in list" :key="node.key">
            <span class="cursor-pointer" @click="toggleChildList(node)">
                <li draggable="true"
                    @drop="(event) => handleDrop(event, node)"
                    @dragstart="(event) => handleDragStart(event, node)"
                    @dragover="allowDrop"
                    class="pi pi-align-justify pr-2 cursor-move" />
                <i class="pi" :class="{'pi-chevron-right' : !node.show, 'pi-chevron-down' : node.show}" />
                {{ node.label }}
            </span>
            <span v-if="node.show">
                <catalog-list :is-child="true" @on-drop-end="handleDropEnd" :list="node.children"></catalog-list>
            </span>
        </li>
    </ul>
</template>

<style scoped>

</style>
