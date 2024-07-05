<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-gray-700 text-lg font-bold mb-3">
                        Upload File
                    </div>

                    <div class="card-body">
                        <div v-if="message != ''" class="text-blue-500 text-md font-bold mb-2">
                            {{ message }}
                        </div>
                        <form @submit="formSubmit" method="POST" id="file-form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" name="name" type="text" placeholder="Name" v-model="name" />
                            </div>

                            <div class="flex items-center justify-center w-full mb-4">
                                <label for="file_input"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                    </div>
                                    <input id="file_input" type="file" class="hidden" v-on:change="onFileChange" />
                                    <br>
                                    <progress max="100" :value.prop="uploadPercentage"></progress>
                                    <br>
                                </label>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            name: '',
            file: '',
            uploadPercentage: 0,
            message: ''
        };
    },
    methods: {
        onFileChange(e) {
            console.log(e.target.files[0]);
            this.file = e.target.files[0];
            this.file = this.$refs.file.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            const config = {
                headers: { 'content-type': 'multipart/form-data' },
                onUploadProgress: function (progressEvent) {
                    this.uploadPercentage = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
                }.bind(this)
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
                    console.log(error);
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