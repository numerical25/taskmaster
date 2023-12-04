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
import Blog from "./views/blog/Blog.vue";
import BlogView from "./views/blog/View.vue";
import Latest from "./views/comments/Latest.vue";
import Index from "./views/installer/Installer.vue";
import Installer from "./views/installer/Installer.vue";

const routes = [
    {
        path: '',
        children: [
            {
                path: '/',
                component: Tasks,
                name: 'home',
                children: [
                ]
            },
            {
                path: '/products',
                children: [
                    {
                        path: '',
                        component: Products,
                        name: 'products',
                        children: [
                        ]
                    },
                    {
                        path: ':id/details',
                        component: ProductView,
                        name: 'product-details',
                        children: [
                        ]
                    },
                ]
            },
            {
                path: '/cart',
                children: [
                    {
                        path: '',
                        component: Cart,
                        name: 'cart',
                        children: [
                        ]
                    },
                    {
                        path: 'checkout',
                        component: Checkout,
                        name: 'checkout',
                        children: [
                        ]
                    },
                    {
                        path: 'success',
                        component: Success,
                        name: 'checkout-success',
                        children: [
                        ]
                    },
                ]
            },
            {
                path: '/task',
                children: [
                    {
                        path: '',
                        component: Tasks,
                        name: 'task',
                        children: [
                        ]
                    },
                    {
                        path: ':id/edit/',
                        component: Edit,
                        name: 'task-edit'
                    },
                    {
                        path: 'create',
                        component: Create,
                        name: 'task-create'
                    },
                ]
            },
            {
                path: '/bubbles',
                component: Test,
                name: 'bubbles'
            },
            {
                path: '/blog',
                children: [
                    {
                        path: '',
                        component: Blog,
                        name: 'blog',
                        children: [

                        ]
                    },
                    {
                        path: ':id/view',
                        component: BlogView,
                        name: 'blog-view'
                    }
                ]
            },
            {
                path: '/comments',
                children: [
                    {
                        path: '',
                        component: Latest,
                        name: 'comments-latest'
                    }
                ]
            },
            {
                path: '/install',
                children: [
                    {
                        path: '',
                        component: Installer,
                        name: 'installer'
                    }
                ]
            }
        ]
    },
];

export default new createRouter({
    history: createWebHistory(),
    routes
});
