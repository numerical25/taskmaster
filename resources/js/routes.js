import Edit from './task/Edit.vue';
import {createRouter, createWebHistory} from "vue-router";
import Tasks from "./Tasks.vue";
import Create from "./task/Create.vue";

const routes = [
    {
        path: '/',
        component: Tasks,
        name: 'home'
    },
    {
        path: '/task/',
        component: Tasks,
        name: 'task'
    },
    {
        path: '/task/edit/:id',
        component: Edit,
        name: 'task-edit'
    },
    {
        path: '/task/create',
        component: Create,
        name: 'task-create'
    },
];

export default new createRouter({
    history: createWebHistory(),
    routes
});
