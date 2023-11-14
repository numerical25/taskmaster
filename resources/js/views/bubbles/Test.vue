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

                const nodesGroup = svg
                    .selectAll('g')
                    .data(nodes)
                    .enter()
                    .append('g');

                const node = nodesGroup
                    .append('circle')
                    .attr('cx', (d) => d.x)
                    .attr('cy', (d) => d.y)
                    .attr('r', 0) // Start with radius 0 for initial animation
                    .attr('fill', (d) => color(d.data.group))
                    .call(d3.drag().on('start', dragstart).on('drag', dragged).on('end', dragend));

                const textNode = nodesGroup
                    .append('text')
                    .attr('x', (d) => d.x)
                    .attr('y', (d) => d.y)
                    .attr('dy', '0.3em')
                    .attr('text-anchor', 'middle')
                    .text((d) => d.data.name)
                    .call(d3.drag().on('start', textDragstart).on('drag', textDragged).on('end', textDragend));

                node
                    .transition()
                    .delay((d, i) => Math.random() * 500)
                    .duration(750)
                    .attr('r', (d) => fixedRadius);

                function dragstart(event, d) {
                    if (!event.active) simulation.alphaTarget(0.3).restart();
                    d.fx = d.x;
                    d.fy = d.y;
                }

                function dragged(event, d) {
                    d.fx = event.x;
                    d.fy = event.y;

                    // Update the position of the corresponding text during drag
                    textNode
                        .filter((textData) => textData === d)
                        .attr('x', d.x)
                        .attr('y', d.y);
                }

                function dragend(event, d) {
                    if (!event.active) simulation.alphaTarget(0);
                    d.fx = null;
                    d.fy = null;
                }

                function textDragstart(event, d) {
                    if (!event.active) simulation.alphaTarget(0.3).restart();
                    d.fx = d.x;
                    d.fy = d.y;
                }

                function textDragged(event, d) {
                    d.fx = event.x;
                    d.fy = event.y;

                    // Update the position of the corresponding circle during drag
                    node
                        .filter((circleData) => circleData === d)
                        .attr('cx', d.x)
                        .attr('cy', d.y);
                }

                function textDragend(event, d) {
                    if (!event.active) simulation.alphaTarget(0);
                    d.fx = null;
                    d.fy = null;
                }

                simulation.on('tick', () => {
                    node.attr('cx', (d) => d.x).attr('cy', (d) => d.y);
                    textNode.attr('x', (d) => d.x).attr('y', (d) => d.y);
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
