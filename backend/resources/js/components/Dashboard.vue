<template>
    <section class="vh-100" style="background-color: hsl(0, 0%, 96%)">
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 ls-tight" v-if="user">
                            Welcome {{ user.name }}<br />
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                            quibusdam tempora at cupiditate quis eum maiores libero
                            veritatis? Dicta facilis sint aliquid ipsum atque?
                        </p>
                        <button type="button" class="btn btn-dark mt-2" @click="logout">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { useRouter } from "vue-router"
import { UserStore } from '@/store/UserStore.js'
export default{
    setup(){
        const router = useRouter();
        const store = UserStore();

        function logout(){
            store.removeToken();
            router.push({name:'Login'})
        }
        return {
            logout
        }
    },
    data() {
        return {
            user: null,
        };
    },
    async mounted() {
        const store = UserStore();
        try {
            const response = await axios.get('/api/user',{
                headers: {
                    'Authorization': `Bearer ${store.getToken}`,
                },
            });
            this.user = response.data;
        } catch (error) {
            console.log(error);
        }
    },
}
</script>
