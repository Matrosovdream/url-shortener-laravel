
import { createApp } from 'vue/dist/vue.esm-bundler';
import ShortenUrlForm from './components/ShortenUrlForm.vue';

const app = createApp({});
app.component('shorten-url-form', ShortenUrlForm);
app.mount('#app');
