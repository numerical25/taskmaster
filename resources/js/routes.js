import Edit from './views/task/Edit.vue';
import {createRouter, createWebHistory} from "vue-router";
import Tasks from "./views/task/Tasks.vue";
import Create from "./views/task/Create.vue";
import Products from "./views/products/Products.vue";
import Cart from "./views/cart/Cart.vue";

const routes = [
    {
        path: '/',
        component: Tasks,
        name: 'home'
    },
    {
        path: '/products',
        component: Products,
        name: 'products',
        children: [
        ]
    },
    {
        path: '/cart',
        component: Cart,
        name: 'cart',
        children: [
        ]
    },
    {
        path: '/task',
        component: Tasks,
        name: 'task',
        children: [
        ]
    },
    {
        path: '/task/:id/edit/',
        component: Edit,
        name: 'task-edit'
    },
    {
        path: '/task/create',
        component: Create,
        name: 'task-create'
    }
];

export default new createRouter({
    history: createWebHistory(),
    routes
});
