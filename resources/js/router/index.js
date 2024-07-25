import { createRouter, createWebHistory } from "vue-router";

import CompaniesIndex from "@/components/companies/CompaniesIndex.vue";
import CompaniesCreate from "@/components/companies/CompaniesCreate.vue";
import CompaniesEdit from "@/components/companies/CompaniesEdit.vue";
import PostsIndex from "@/components/posts/PostsIndex.vue";
import PostsCreate from "@/components/posts/PostsCreate.vue";
import PostsEdit from "@/components/posts/PostsEdit.vue";
import ExampleComponent from "@/components/companies/ExampleComponent.vue";
import TestComponent from "@/components/companies/TestComponent.vue";
import Dashboard from "../components/pages/Dashboard.vue";

const routes = [
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/companies",
        name: "companies.list",
        component: CompaniesIndex,
    },
    {
        path: "/companies/create",
        name: "companies.create",
        component: CompaniesCreate,
    },
    {
        path: "/companies/:id/edit",
        name: "companies.edit",
        component: CompaniesEdit,
        props: true,
    },
    {
        path: "/upload/file",
        name: "upload.file",
        component: ExampleComponent,
    },
    // {
    //     path: "/export/file",
    //     name: "export.file",
    //     component: CompaniesIndex,
    // },
    {
        path: "/test/comp",
        name: "test.comp",
        component: TestComponent,
    },
    {
        path: "/posts",
        name: "posts.list",
        component: PostsIndex,
    },
    {
        path: "/posts/create",
        name: "posts.create",
        component: PostsCreate,
    },
    {
        path: "/posts/:id/edit",
        name: "posts.edit",
        component: PostsEdit,
        props: true,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
