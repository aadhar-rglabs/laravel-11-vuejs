<template>
    <div class="flex mb-4 place-content-end">
        <div class="h-10 px-4 font-semibold rounded-md border border-slate-200 text-slate-900 py-1">
            <router-link :to="{ name: 'companies.create' }" class="text-sm font-medium">Create company</router-link>
        </div>
    </div>
    <div class="min-w-full overflow-hidden overflow-x-auto align-middle sm:rounded-md">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Name</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Email</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Address</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Website</span>
                </th>
            </tr>
            </thead>
 
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="item in companies" :key="item.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.name }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.email }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.address }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.website }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-center text-gray-900 whitespace-no-wrap">
                        <router-link :to="{ name: 'companies.edit', params: { id: item.id } }"
                            class="px-4 py-2 rounded-md text-gray border border-transparent bg-cyan-500 hover:bg-cyan-600 cursor-pointer shadow-md">Edit</router-link>
                        <button @click="deleteCompany(item.id)"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 shadow-md">
                                Delete</button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import useCompanies from '@/composables/companies'
import { onMounted } from 'vue';
const { companies, getCompanies, destroyCompany  } = useCompanies()
const deleteCompany = async (id) => {
    if (!window.confirm('You sure?')) {
        return
    }
    await destroyCompany(id)
    await getCompanies()
}

onMounted(getCompanies)
</script>