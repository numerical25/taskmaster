import Edit from '../views/task/Edit.vue';
import {createRouter, createWebHistory} from "vue-router";
import Tasks from "../views/task/Tasks.vue";
import CreateAdmin from "./pages/Catalog/Create.vue";
import Products from "../views/products/Products.vue";
import Cart from "../views/cart/Cart.vue";
import ProductView from "../views/products/View.vue";
import Checkout from "../views/cart/checkout/Checkout.vue";
import Test from "../views/bubbles/Test.vue";
import Success from "../views/cart/checkout/Success.vue";
import Blog from "../views/blog/Blog.vue";
import BlogView from "../views/blog/View.vue";

const routes = [
    {
        path: '/admin',
        component: CreateAdmin,
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
        path: '/bubbles',
        component: Test,
        name: 'bubbles'
    },
    {
        path: '/blog',
        component: Blog,
        name: 'blog'
    },
    {
        path: '/blog/:id/view',
        component: BlogView,
        name: 'blog-view'
    }
];

export default new createRouter({
    history: createWebHistory(),
    routes
});