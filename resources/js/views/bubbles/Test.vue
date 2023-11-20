<script>
import { defineComponent, ref, onMounted, onBeforeMount, onBeforeUnmount, nextTick } from 'vue';
import * as d3 from 'd3';
import ApiService from "../../services/ApiService.js";
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Dock from 'primevue/dock';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
export default defineComponent({
    setup() {
        const containerRef = ref(null);
        let simulation;
        const tickerList = ref([]);
        onMounted(async () => {
            await nextTick();
            let apiService = new ApiService();
            let tickerData = await apiService.get('crypto/cptickers');
            tickerList.value = tickerData.data.data;
            console.log(tickerList.value);
            if (containerRef.value) {
                const width = window.innerWidth;
                const height = window.innerHeight;

                // Update the size of the container
                containerRef.value.style.width = `${width}px`;
                containerRef.value.style.height = `${height}px`;
                const data = {
                    children: tickerData.data.data
                };
                const hierarchy = d3.hierarchy(data).sum((d) => d.value);
                const packLayout = d3.pack().size([width, height]).padding(1.5);
                const nodes = packLayout(hierarchy).leaves();
                const maxRadius = 50;
                const smallConstant = 0.001; // You can adjust this value based on your data
                const radiusScale = d3.scaleLog()
                    .domain([smallConstant, d3.max(nodes, d => {
                        const value = Number(d.data.quote[0].volume_24h) + smallConstant;
                        return value;
                    })])
                    .range([1, maxRadius]);
                const fontScale = d3.scaleLog()
                    .domain([smallConstant, d3.max(nodes, d => { return Number(d.data.quote[0].volume_24h);})])
                    .range([0.0001, 25]);
                simulation = d3
                    .forceSimulation(nodes)
                    .force('cluster', null)
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
                    .style('cursor', 'pointer')
                    .attr('r', 0) // Start with radius 0 for initial animation
                    .attr('fill', (d) => {
                        var test = d.data.quote[0].volume_24_change_24h;
                        return (Number(d.data.quote[0].volume_24h_change_24h) > 0 ? '#00FF00' : '#FF0000');
                    })
                    .attr('opacity', 0.5)
                    .call(d3.drag().on('start', dragstart).on('drag', dragged).on('end', dragend));

                const textNode = nodesGroup
                    .append('text')
                    .attr('x', (d) => d.x)
                    .attr('y', (d) => d.y)
                    .attr('dy', '0.3em')
                    .attr('text-anchor', 'middle')
                    .each(function(d) {
                        const textLines = d.data.symbol.split('<br>');
                        let currNode = this;
                        let lineVal = (textLines.length > 1 ? -13 : 0);
                        textLines.forEach(function(line, index) {
                            d3.select(currNode)
                                .append('tspan')
                                .attr('x', 0)
                                .attr('y', lineVal)
                                .style('cursor', 'pointer')
                                .style('font-size', d => (fontScale(d.data.quote[0].volume_24h)).toString()+"px")
                                .text(line);
                            lineVal = lineVal + 18;
                            d3.select(currNode)
                                .append('tspan')
                                .attr('x', 0)
                                .attr('y', lineVal)
                                .style('cursor', 'pointer')
                                .style('font-size', d => (fontScale(d.data.quote[0].volume_24h)).toString()+"px")
                                .text((d) => Number(d.data.quote[0].volume_24h_change_24h));
                        });
                    })
                    .call(d3.drag().on('start', textDragstart).on('drag', textDragged).on('end', textDragend));

                node
                    .transition()
                    .delay((d, i) => Math.random() * 500)
                    .duration(750)
                    .attr('r', d => {
                        const value = Number(d.data.quote[0].volume_24h) + smallConstant;
                        const radius = radiusScale(value);
                        return radius;
                    });
                let centeringForce = true; // Variable to track whether the centering force is active
                const resizeHandler = () => {
                    // Update the size of the canvas when the window is resized
                    const width = containerRef.value.clientWidth;
                    const height = containerRef.value.clientHeight;
                    // Toggle the centering force
                    centeringForce = true;
                    if(centeringForce) {
                        // Update the size of the SVG element
                        svg.attr('width', width).attr('height', height);
                        const deltaX = width + window.innerWidth;
                        const deltaY = height + window.innerHeight;
                        // Apply forces based on the resizing direction
                        simulation.force('x', d3.forceX(width / 2).strength(0.01 * Math.sign(deltaX)));
                        simulation.force('y', d3.forceY(height / 2).strength(0.01 * Math.sign(deltaY)));

                        // Restart the simulation
                    }
                    setTimeout(() => {
                        centeringForce = false;
                        // Clear the forces when resizing is done
                        simulation.force('x', null);
                        simulation.force('y', null);
                        simulation.alpha(1).restart();
                    },500)
                };
                window.addEventListener('resize', resizeHandler);
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
                            const r = radius(node) + radiusScale(node.data.quote[0].volume_24h);
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
                        if (node.x - radiusScale(node.data.quote[0].volume_24h) < 0 || node.x + radiusScale(node.data.quote[0].volume_24h) > width) {
                            node.initialAngle = Math.PI - node.initialAngle; // Reverse angle
                        }

                        if (node.y - radiusScale(node.data.quote[0].volume_24h) < 0 || node.y + radiusScale(node.data.quote[0].volume_24h) > height) {
                            node.initialAngle = -node.initialAngle; // Reverse angle
                        }
                        // Function to check if two nodes are colliding
                        function areColliding(nodeA, nodeB) {
                            const dx = nodeA.x - nodeB.x;
                            const dy = nodeA.y - nodeB.y;
                            const distance = Math.sqrt(dx * dx + dy * dy);
                            return distance < 2 * radiusScale(node.data.quote[0].volume_24h); // Adjust the factor as needed
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
            containerRef, tickerList
        };
    },
    methods: {
        showMaximizedDialog() {
            this.visible = true;
            this.$refs.cryptoInfo.$params.state.maximized = true;
        },
    },
    data() {
        return {
            apiSerivce: new ApiService(),
            visible: false,
            tickerList: []
        };
    },
    components: {Button, Dialog, Dock, DataTable, Column}
});
</script>

<template>
    <div class="fixed bottom-7 right-10">
        <Button label="LIST" icon="pi pi-external-link" @click="showMaximizedDialog()" />
    </div>

    <Dialog ref="cryptoInfo"
            maximizable
            v-model:visible="visible"
            modal header="Crypto Ticker List"  :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
        <p class="m-0">
            <DataTable :value="tickerList" tableStyle="min-width: 50rem">
                <Column field="symbol" header="Symbol"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="quote" header="Volume 24">
                    <template #body="{data}">
                        {{ data.quote[0].volume_24h }}
                    </template>
                </Column>
            </DataTable>
        </p>
    </Dialog>
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
