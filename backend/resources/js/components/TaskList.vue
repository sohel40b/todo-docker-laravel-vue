<template>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-50">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8">
                    <h2 class="mb-4"> Task List </h2>
                    <p class="text-success" v-if="messages">{{ messages }}</p>
                    <p class="text-danger" v-if="error">{{ error }}</p>
                    <form @submit.prevent="task" class="d-flex justify-content-center align-items-center mb-4">
                        <div class="form-outline flex-fill">
                            <input type="text" class="form-control" placeholder="Add Task" v-model="form.task_name"/>
                        </div>
                        <div class="form-outline flex-fill">
                            <select v-model="form.todo_id" class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option v-for="todo in todos" :key="todo.id" :value="todo.id">{{ todo.name }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info ms-2">Add</button>
                    </form>
                    <div class="card">
                        <div class="card-header p-3">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Task List</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#ID</th>
                                        <th scope="col">Task Name</th>
                                        <th scope="col">Todo Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="fw-normal" v-for="task in tasks" :key="task">
                                        <th>
                                            <span>{{task.id}}</span>
                                        </th>
                                        <td class="align-middle">
                                            <p>{{task.task_name}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p>{{task.name}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-danger" @click="deleteData(task.id)">Delete</button>
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
    data() {
        return {
            todos: [],
        };
    },
    async mounted() {
        const store = UserStore();
        try {
            axios.get('/api/todos',{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            }).then(res => {
                this.todos = res.data.data;
            });
        } catch (error) {
            console.log(error);
        }
    },
    setup(){
        const router = useRouter()
        const store = UserStore();
        let form = reactive({
            task_name: '',
            todo_id: '',
        });
        let error = ref('')
        let messages = ref('')
        const state = reactive({
            tasks: []
        })
        const fetchTasks = async () => {
            const response = await axios.get('/api/tasks',{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            });
            state.tasks = response.data.data;
        }
        fetchTasks();
        const task = async() =>{
            await axios.post('/api/tasks',form,{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            }).then(res=>{
                if(res.data.status == true){
                    fetchTasks();
                    router.push({name:'TaskList'})
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

            axios.delete('/api/tasks/'+id,{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            }).then(res=>{
                console.log(res);
                if(res.data.status == true){
                    fetchTasks();
                    console.log('Sucessfully Deleted');
                }else{
                    error.value = res.data.message;
                }
            }).catch(e=>{
                error.value = e.response.data.message
            })
        }
        return{
            form,
            task,
            error,
            messages,
            deleteData,
            ...toRefs(state),
        }
    },
}
</script>
