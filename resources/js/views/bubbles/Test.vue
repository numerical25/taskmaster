<script>
import { defineComponent, ref, onMounted, onBeforeMount, onBeforeUnmount, nextTick } from 'vue';
import * as d3 from 'd3';
import { forceCluster } from 'd3-force-cluster';
import { forceSimulation, forceCollide } from "d3-force";
export default defineComponent({
    setup() {
        const containerRef = ref(null);
        let simulation;

        onMounted(async () => {
            await nextTick();
            if (containerRef.value) {
                const width = 1000;
                const height = 800;
                const data = {
                    children: [
                        { name: 'A', group: 1, value: 1 },
                        { name: 'B', group: 2, value: 1 },
                        { name: 'C', group: 1, value: 1 },
                        { name: 'D', group: 1, value: 1 },
                        { name: 'E', group: 1, value: 1 },
                        { name: 'F', group: 1, value: 1 },
                        { name: 'G', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                        { name: 'H', group: 1, value: 1 },
                    ],
                };
                const color = d3.scaleOrdinal(d3.schemeCategory10);
                const hierarchy = d3.hierarchy(data).sum((d) => d.value);
                const packLayout = d3.pack().size([width, height]).padding(1.5);
                const nodes = packLayout(hierarchy).leaves();
                const fixedRadius = 20;

                simulation = d3
                    .forceSimulation(nodes)
                    .force('x', d3.forceX(width / 2).strength(0.01))
                    .force('y', d3.forceY(height / 2).strength(0.01))
                    .force('cluster', forceCluster())
                    .force('collide', forceCollide().radius((d) => fixedRadius).strength(1).iterations(1));

                const svg = d3.select(containerRef.value).append('svg').attr('width', width).attr('height', height);

                const node = svg
                    .append('g')
                    .selectAll('circle')
                    .data(nodes)
                    .join('circle')
                    .attr('cx', (d) => d.x)
                    .attr('cy', (d) => d.y)
                    .attr('r', (d) => fixedRadius) // Ensure that d.r is defined
                    .attr('fill', (d) => color(d.data.group))
                    .call(d3.drag().on('start', dragstart).on('drag', dragged).on('end', dragend));



                function dragstart(event) {
                    if (!event.active) simulation.alphaTarget(0.3).restart();
                    if (event.subject) {
                        event.subject.fx = event.subject.x;
                        event.subject.fy = event.subject.y;
                    }
                }

                function dragged(event) {
                    if (event.subject) {
                        event.subject.fx = event.x;
                        event.subject.fy = event.y;
                    }
                }

                function dragend(event) {
                    if (!event.active) simulation.alphaTarget(0);
                    if (event.subject) {
                        event.subject.fx = null;
                        event.subject.fy = null;
                    }
                }
                simulation.on('tick', () => {
                    node.attr('cx', (d) => d.x).attr('cy', (d) => d.y);
                });

                function getRndInteger(min, max) {
                    return Math.floor(Math.random() * (max - min)) + min;
                }
            }
        });

        return {
            containerRef,
        };
    },
});
</script>

<template>
        <svg class="w-full h-full" ref="containerRef"></svg>
</template>

<style scoped>
/* Add some basic styling */
circle {
    fill: steelblue;
    stroke: white;
    stroke-width: 2px;
}
</style>
