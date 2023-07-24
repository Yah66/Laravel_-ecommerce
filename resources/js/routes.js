import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router'; // Import Vue Router

import ExampleComponent from './components/ExampleComponent.vue';
import LanguageComponent from './components/LanguageComponent.vue';
import CreateLanguageComponent from './components/CreateLanguageComponent.vue';

const app = createApp({});
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'home',
            path: '/admin/languages',
            component: LanguageComponent
        },
        {
            name: 'create',
            path: '/admin/languages/create',
            component: CreateLanguageComponent
        }
    ]
});

app.component('example-component', ExampleComponent);
app.component('language-component', LanguageComponent);
app.use(router); // Use the router instance in the Vue app

app.mount('#app');
