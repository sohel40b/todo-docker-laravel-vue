import { createRouter, createWebHistory } from 'vue-router'
import { UserStore } from '@/store/UserStore.js'
import NotFound from './components/NotFound.vue'
import Welcome from './components/Welcome.vue'
import Register from './components/Register.vue'
import Login from './components/Login.vue'
import Dashboard from './components/Dashboard.vue'
import TodoList from './components/TodoList.vue'
import TaskList from './components/TaskList.vue'

const routes = [
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: NotFound
    },
    {
        path: '/',
        name: 'Welcome',
        component: Welcome,
        meta:{
            auth:false
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta:{
            auth:false
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta:{
            auth:false
        }
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta:{
            auth:true
        }
    },
    {
        path: '/todo-list',
        name: 'TodoList',
        component: TodoList,
        meta:{
            auth:true
        }
    },
    {
        path: '/task-list',
        name: 'TaskList',
        component: TaskList,
        meta:{
            auth:true
        }
    },

];
const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to,from) =>{
    const store = UserStore();
    if(to.meta.auth && store.token == 0){
        return { name : 'Login'}
    }
    if(to.meta.auth == false && store.token != 0){
        return { name : 'Dashboard'}
    }
})

export default router;
