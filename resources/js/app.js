/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue';
import axios from 'axios';

import App from './App.vue';
import router from './router';

const app = createApp(App);

app.config.globalProperties.$axios = axios;

app.use(router);

app.mount('#app');
