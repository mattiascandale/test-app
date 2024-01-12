import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)
app.config.globalProperties.$api_url = 'http://127.0.0.1:8000';

app.use(router)
app.mount('#app')
