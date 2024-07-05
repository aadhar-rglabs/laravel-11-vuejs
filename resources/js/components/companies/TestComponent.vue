<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k"
            class="bg-white-400 text-red-500 rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form v-on:submit.prevent="formSubmit" class="space-y-6">
        <p>
            What do you need?
            <input type="text"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required placeholder="item name.." name="name" v-model="itemName">
        </p>
        <p>
            How many?
            <input type="number"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="number of items.." name="number" v-model="itemNumber">
        </p>
        <button type="submit"
            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Add item
        </button>
    </form>

    <div>
        <p>Shopping list:</p>
        <ul>
            <li v-for="item in shoppingList">{{ item.name }}, {{ item.number }}</li>
        </ul>
    </div>
</template>
<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            itemName: null,
            itemNumber: null,
            shoppingList: [
                { name: 'Tomatoes', number: 5 }
            ]
        }
    },
    methods: {
        formSubmit(e) {
            e.preventDefault();
            let item = {
                name: this.itemName,
                number: this.itemNumber
            }
            this.shoppingList.push(item)
            this.itemName = null
            this.itemNumber = null
            
            let currentObj = this;
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            let formData = new FormData();
            const name = formData.get('name');
            formData.append('file', this.file);
            formData.append('name', currentObj.name);
            axios.post('/upload/file', formData, config)
                .then(function (response) {
                    // console.table(response);
                    if (currentObj.message) {
                        currentObj.message = response.data.success;
                    }
                })
                .catch(function (error) {
                    // console.log(error);
                    if (error.response.status === 422) {
                        for (const key in error.response.data.errors) {
                            currentObj.message = " " + error.response.data.errors[key]
                        }
                    }
                    currentObj.output = error.response.data.message;
                });
        }
    }
}
</script>