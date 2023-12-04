import {createRouter, createWebHistory} from "vue-router";
import CreateAdmin from "./pages/Catalog/Create.vue";
import Editor from "./pages/Editor/Editor.vue";
import Dashboard from "./pages/Dashboard/Dashboard.vue";

const routes = [
    {
        // Todo: Need to fix all routes to have a children structure
        path: '/admin',
        children: [
            {
                path: '/',
                component: Dashboard,
                name: 'dashboard',
                children: [
                ]
            },
            {
                path: '',
                component: CreateAdmin,
                name: 'catalog',
                children: [
                ]
            },
            {
                path: 'editor',
                component: Editor,
                name: 'editor',
                children: [
                ]
            },
        ]
    }
];

export default new createRouter({
    history: createWebHistory(),
    routes
});
