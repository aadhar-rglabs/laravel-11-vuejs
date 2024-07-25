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
                            v-model="form.title">
                </div>
            </div>
 
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="my-2">
                    <textarea class="block w-full my-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 resize rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description" id="description" v-model="form.description" ></textarea>
                </div>
            </div>
 
            
        </div>
 
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
    </form>
</template>
 
<script setup>
import useCompanies from '@/composables/companies'
import { onMounted } from 'vue';
 
const { errors, company, updateCompany, getCompany } = useCompanies()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})
 
onMounted(() => getCompany(props.id))
 
const saveCompany = async () => {
    await updateCompany(props.id)
}
</script>