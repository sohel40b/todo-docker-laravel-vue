<template>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-50">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8">
                    <h2 class="mb-4"> Todo List </h2>
                    <p class="text-success" v-if="messages">{{ messages }}</p>
                    <p class="text-danger" v-if="error">{{ error }}</p>
                    <form @submit.prevent="todo" class="d-flex justify-content-center align-items-center mb-4">
                        <div class="form-outline flex-fill">
                            <input type="text" class="form-control" placeholder="Add Todo" v-model="form.name"/>
                        </div>
                        <button type="submit" class="btn btn-info ms-2">Add</button>
                    </form>
                    <div class="card">
                        <div class="card-header p-3">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Todo List</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="fw-normal" v-for="todo in todos" :key="todo">
                                        <th>
                                            <span>{{todo.id}}</span>
                                        </th>
                                        <td class="align-middle">
                                            <p>{{todo.name}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p>{{todo.status}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-danger" @click="deleteData(todo.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { reactive,ref,toRefs } from 'vue'
import { useRouter } from "vue-router"
import { UserStore } from '@/store/UserStore.js'
export default{
    setup(){
        const router = useRouter()
        const store = UserStore();
        let form = reactive({
            name: '',
        });
        let error = ref('')
        let messages = ref('')
        const state = reactive({
            todos: []
        })
        const fetchTodos = async () => {
            const response = await axios.get('/api/todos',{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            });
            state.todos = response.data.data;
        }
        fetchTodos();
        const todo = async() =>{
            await axios.post('/api/todos',form,{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            }).then(res=>{
                if(res.data.status == true){
                    fetchTodos();
                    router.push({name:'TodoList'})
                    console.log('Data Found');
                    messages.value = res.data.message;
                }else{
                    error.value = res.data.message;
                }
            }).catch(e=>{
                error.value = e.response.data.message
            })
        };
        const deleteData = async (id) =>{

            axios.delete('/api/todos/'+id,{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            }).then(res=>{
                fetchTodos();
                console.log('Sucessfully Deleted');
            }).catch(e=>{
                error.value = e.response.data.message
            })
        }
        return{
            form,
            todo,
            error,
            messages,
            deleteData,
            ...toRefs(state),
        }
    },
}
</script>
