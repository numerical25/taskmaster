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
                const width = containerRef.value.clientWidth;
                const height = containerRef.value.clientHeight;
                const data = {
                    children: [
                        { name: "New York<br>Vs<br>Miami", group: 1, value: 1 },
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
                const fixedRadius = 40;

                simulation = d3
                    .forceSimulation(nodes)
                    // .force('x', d3.forceX(width / 2).strength(0.01))
                    // .force('y', d3.forceY(height / 2).strength(0.01))
                    .force('cluster', null)
                    // .force('move', d3.forceManyBody().strength(5).distanceMax(200).distanceMin(50))
                    .force('collide', customForceCollide().radius((d) => 20).strength(0.2));
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
                    .attr('opacity', 0.5)
                    .call(d3.drag().on('start', dragstart).on('drag', dragged).on('end', dragend));

                // nodes.forEach((node) => {
                //     node.x = Math.random() * width;
                //     node.y = Math.random() * height;
                //     node.vx = Math.random() * 2 - 1; // Random x velocity between -1 and 1
                //     node.vy = Math.random() * 2 - 1; //
                // });

                const textNode = nodesGroup
                    .append('text')
                    .attr('x', (d) => d.x)
                    .attr('y', (d) => d.y)
                    .attr('dy', '0.3em')
                    .attr('text-anchor', 'middle')
                    .each(function(d) {
                        const textLines = d.data.name.split('<br>');
                        let currNode = this;
                        let lineVal = (textLines.length > 1 ? -13 : 0);
                        textLines.forEach(function(line, index) {
                            d3.select(currNode)
                                .append('tspan')
                                .attr('x', 0)
                                .attr('y', lineVal)
                                .text(line);
                            lineVal = lineVal + 18;
                        });
                    })
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
                    d.dragStartX = event.x;
                    d.dragStartY = event.y;
                }
                function customForceCollide() {
                    let nodes;
                    let strength = 0.2;
                    let radius = d => 1;

                    function force(alpha) {
                        const quadtree = d3.quadtree(nodes, d => d.x, d => d.y);

                        nodes.forEach(node => {
                            const r = radius(node) + fixedRadius;
                            const nx1 = node.x - r, ny1 = node.y - r;
                            const nx2 = node.x + r, ny2 = node.y + r;

                            quadtree.visit((quad, x1, y1, x2, y2) => {
                                if (!quad.length) {
                                    do {
                                        const other = quad.data;
                                        if (other && (other !== node)) {
                                            let x = node.x - other.x;
                                            let y = node.y - other.y;
                                            let distance = Math.sqrt(x * x + y * y);
                                            const minDistance = r + radius(other);

                                            if (distance < minDistance) {
                                                distance = (distance - minDistance) / distance * alpha * strength;
                                                node.x -= x *= distance;
                                                node.y -= y *= distance;
                                                other.x += x;
                                                other.y += y;
                                            }
                                        }
                                    } while (quad = quad.next);
                                }
                                return x1 > nx2 || x2 < nx1 || y1 > ny2 || y2 < ny1;
                            });
                        });
                    }

                    force.initialize = _ => nodes = _;

                    force.strength = _ => (_ === undefined ? strength : (strength = +_, force));
                    force.radius = _ => (_ === undefined ? radius : (radius = typeof _ === 'function' ? _ : constant(+_), force));

                    return force;
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
                    // Calculate the angle between drag start and end positions
                    const dx = event.x - d.dragStartX;
                    const dy = event.y - d.dragStartY;
                    d.initialAngle = Math.atan2(dy, dx);
                }

                function textDragstart(event, d) {
                    if (!event.active) simulation.alphaTarget(0.3).restart();
                    d.fx = d.x;
                    d.fy = d.y;
                    d.dragStartX = event.x;
                    d.dragStartY = event.y;
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
                    // Calculate the angle between drag start and end positions
                    const dx = event.x - d.dragStartX;
                    const dy = event.y - d.dragStartY;
                    d.initialAngle = Math.atan2(dy, dx);
                }

                nodes.forEach((node) => {
                    node.x = Math.random() * width;
                    node.y = Math.random() * height;
                    node.initialAngle = Math.random() * 2 * Math.PI; // Store the initial angle
                    node.vx = Math.cos(node.initialAngle);
                    node.vy = Math.sin(node.initialAngle);
                });

                simulation.alphaDecay(0);
                const angle = Math.random() * 2 * Math.PI;
                simulation.on('tick', () => {
                    const speed = 0.2;
                    nodes.forEach((node) => {
                        // Update position based on the initial angle
                        node.x += speed * Math.cos(node.initialAngle);
                        node.y += speed * Math.sin(node.initialAngle);

                        // Bounce off the walls
                        if (node.x - fixedRadius < 0 || node.x + fixedRadius > width) {
                            node.initialAngle = Math.PI - node.initialAngle; // Reverse angle
                        }

                        if (node.y - fixedRadius < 0 || node.y + fixedRadius > height) {
                            node.initialAngle = -node.initialAngle; // Reverse angle
                        }
                        // Function to check if two nodes are colliding
                        function areColliding(nodeA, nodeB) {
                            const dx = nodeA.x - nodeB.x;
                            const dy = nodeA.y - nodeB.y;
                            const distance = Math.sqrt(dx * dx + dy * dy);
                            return distance < 2 * fixedRadius; // Adjust the factor as needed
                        }
                        // Check for collisions with other nodes
                        // nodes.forEach((otherNode, index) => {
                        //     if (node !== otherNode) {
                        //         const dx = node.x - otherNode.x;
                        //         const dy = node.y - otherNode.y;
                        //         const distance = Math.sqrt(dx * dx + dy * dy);
                        //
                        //         // Check for collisions with other nodes
                        //         for (let i = 0; i < nodes.length; i++) {
                        //             if (i !== index && areColliding(node, nodes[i])) {
                        //                 // Reverse angles for both colliding nodes
                        //                 nodes[i].initialAngle = Math.PI - nodes[i].initialAngle;
                        //                 node.initialAngle = Math.PI - node.initialAngle;
                        //             }
                        //         }
                        //     }
                        // });
                    });

                    node.attr('cx', (d) => d.x).attr('cy', (d) => d.y);
                    textNode.attr('transform', (d) => `translate(${d.x},${d.y})`);
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
