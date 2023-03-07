import './bootstrap';
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './route.js'
import App from './layouts/App.vue'

createApp(App)
    .use(router)
    .use(createPinia())
    .mount('#app')
