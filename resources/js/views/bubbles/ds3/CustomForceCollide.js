import * as d3 from "d3";

export default function customForceCollide(radiusScale) {
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
