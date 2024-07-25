import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
 
export default function usePosts() {
    const post = ref([])
    const posts = ref([])
 
    const errors = ref('')
    const router = useRouter()
 
    const getPosts = async () => {
        let response = await axios.get('/api/posts')
        posts.value = response.data.data
    }
 
    const getPost = async (id) => {
        let response = await axios.get(`/api/posts/${id}`)
        post.value = response.data.data
    }
 
    const storePost = async (data) => {
        // console.log("data: ");
        console.log("storePost: ");
        console.log(data);
        errors.value = ''
        try {
            await axios.post('/api/posts', data)
            await router.push({ name: 'posts.list' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
 
    }
 
    const updatePost = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/posts/${id}`, company.value)
            await router.push({ name: 'posts.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyPost = async (id) => {
        await axios.delete(`/api/posts/${id}`)
    }

    const exportPosts = async () => {
        let response = await axios.post('/export/posts')
    }
 
    return {
        errors,
        post,
        posts,
        getPost,
        getPosts,
        storePost,
        updatePost,
        destroyPost,
        exportPosts,
    }
}