require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
    { path: '/', component: require('./components/List.vue') },
    { path: '/create', component: require('./components/Create.vue') },
]

const router = new VueRouter({
    routes
});

Vue.component('list-component', require('./components/List.vue'));
Vue.component('create-component', require('./components/Create.vue'));

const app = new Vue({
    el: '#app',
    router
});
