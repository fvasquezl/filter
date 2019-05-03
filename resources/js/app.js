/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const DashboardIndex = require('./components/dashboard/Index.vue').default;
const ProfileIndex = require('./components/profile/Index.vue').default;
const UserIndex = require('./components/users/Index.vue').default;

const routes =[
    {
        path:'/dashboard',
        name: 'dashboard.Index.vue',
        component : DashboardIndex
    },
    {
        path:'/profile',
        name: 'profile.Index.vue',
        component : ProfileIndex
    },
    {
        path:'/users',
        name: 'users.Index.vue',
        component : UserIndex
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router
});
