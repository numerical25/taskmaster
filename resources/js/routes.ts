import Edit from './views/task/Edit.vue';
import {createRouter, createWebHistory} from "vue-router";
import Tasks from "./views/task/Tasks.vue";
import Create from "./views/task/Create.vue";
import Products from "./views/products/Products.vue";
import Cart from "./views/cart/Cart.vue";
import ProductView from "./views/products/View.vue";
import Checkout from "./views/cart/checkout/Checkout.vue";
import Test from "./views/bubbles/Test.vue";
import Success from "./views/cart/checkout/Success.vue";

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
        path: '/products',
        component: Products,
        name: 'store',
        children: [
        ]
    },
    {
        path: '/products/:id/details',
        component: ProductView,
        name: 'product-details',
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
        path: '/cart/checkout',
        component: Checkout,
        name: 'checkout',
        children: [
        ]
    },
    {
        path: '/cart/success',
        component: Success,
        name: 'checkout-success',
        children: [
        ]
    },
    {
        path: '/cart/task',
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
    },
    {
        path: '/bubbles',
        component: Test,
        name: 'bubbles'
    }
];

export default new createRouter({
    history: createWebHistory(),
    routes
});
