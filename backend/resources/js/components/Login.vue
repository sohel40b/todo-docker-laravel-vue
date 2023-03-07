<template>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <h2 class="mb-4"> Login </h2>
            <p class="text-danger" v-if="error">{{ error }}</p>
            <form @submit.prevent="login">
                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example3">Email address</label>
                    <input type="email" id="form3Example3" class="form-control form-control" placeholder="Enter a valid email address" v-model="form.email"/>
                </div>
                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example4">Password</label>
                    <input type="password" id="form3Example4" class="form-control form-control" placeholder="Enter password" v-model="form.password"/>
                </div>
                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <router-link to='/register' class="link-danger">Register</router-link></p>
                </div>
            </form>
        </div>
        </div>
    </div>
</template>

<script>
import { reactive,ref } from 'vue'
import { useRouter } from "vue-router"
import { UserStore } from '@/store/UserStore.js'
export default{
    setup(){
        const router = useRouter();
        const store = UserStore();
        let form = reactive({
            email: '',
            password: ''
        });
        let error = ref('')
        const login = async() =>{
            await axios.post('/api/login',form).then(res=>{
                if(res.data.status == true){
                    store.setToken(res.data.token)
                    router.push({name:'Dashboard'})
                    console.log('success');
                }else{
                    error.value = res.data.message;
                }
            })
        }
        return{
            form,
            login,
            error
        }
    }
}
</script>
