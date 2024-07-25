import { createRouter, createWebHistory } from "vue-router";

import CompaniesIndex from "@/components/companies/CompaniesIndex.vue";
import CompaniesCreate from "@/components/companies/CompaniesCreate.vue";
import CompaniesEdit from "@/components/companies/CompaniesEdit.vue";
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
        name: "companies.index",
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
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
