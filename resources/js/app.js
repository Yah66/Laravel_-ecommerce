import './bootstrap';
import { createApp } from 'vue';
import LanguageComponent from './components/LanguageComponent.vue';
import Routes from './routes.js';

const app = createApp({});
const router = createRouter({
    routes: Routes,
    history: createWebHistory(),
});
app.use(router);
app.component('language-component', LanguageComponent);

app.mount('#app');
