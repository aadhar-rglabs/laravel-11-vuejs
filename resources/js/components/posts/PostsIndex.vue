<template>
    <div class="flex mb-4 place-content-end">
        <div class="h-10 px-4 font-semibold rounded-md border border-slate-200 text-slate-900 py-1">
            <router-link :to="{ name: 'posts.create' }" class="text-sm font-medium">Create Post</router-link>
        </div>
        <div class="h-10 ml-2 px-4 font-semibold rounded-md border border-slate-200 text-slate-900 py-1">
            <form class="space-y-6" v-on:submit.prevent="downloadFile">
                <button type="submit" class="text-sm font-medium">
                    Export
                </button>
            </form>
        </div>
    </div>
    <div class="min-w-full overflow-hidden overflow-x-auto align-middle sm:rounded-md">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Title</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Description</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Image</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Action</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <template v-for="item in posts" :key="item.id">
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.title }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.description }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <img :src="item.file" width="80" alt="">
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-center text-gray-900 whitespace-no-wrap">
                            <router-link :to="{ name: 'posts.edit', params: { id: item.id } }"
                                class="px-4 py-2 rounded-md text-gray border border-gray-800 bg-cyan-500 hover:bg-cyan-600 cursor-pointer shadow-sm">Edit</router-link>
                            <button @click="deletePost(item.id)"
                                class="inline-flex items-center ml-2 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 shadow-md">
                                Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import usePosts from '@/composables/posts'
import { onMounted } from 'vue';
const { posts, getPosts, destroyPost, exportPosts } = usePosts()
const deletePost = async (id) => {
    if (!window.confirm('Are you sure??')) {
        return false;
    }
    await destroyPost(id)
    await getPosts()
}

const downloadFile = async () => {
    if (!window.confirm('Are you sure??')) {
        return false;
    }
    await exportPosts()
    await getPosts()
}

onMounted(getPosts)
</script>