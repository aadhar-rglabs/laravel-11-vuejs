<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>
 
    <form class="space-y-6" v-on:submit.prevent="savePost">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="my-2">
                    <input type="text" name="title" id="title"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="post.title">
                </div>
            </div>
 
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="my-2">
                    <textarea class="block w-full my-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 resize rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description" id="description" v-model="post.description" ></textarea>
                </div>
            </div>

            <div class="flex items-center justify-center w-full my-4">
                <label for="file_input"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                            800x400px)</p>
                    </div>
                    <input id="file_input" type="file" name="file" ref="file" class="hidden"
                        v-on:change="onFileChange($event)"  />
                    <br>
                    <progress max="100" :value.prop="uploadPercentage"></progress>
                    <br>
                </label>
            </div>
 
        </div>
 
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
    </form>
</template>
 
<script setup>
import usePosts from '@/composables/posts'
import { onMounted } from 'vue';
 
const { errors, post, updatePost, getPost } = usePosts()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})
 
onMounted(() => getPost(props.id))
 
const savePost = async () => {
    await updatePost(props.id)
}
</script>