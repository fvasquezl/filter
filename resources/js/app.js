/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Gate from "./Gate"
Vue.prototype.$gate = new Gate(window.user);


import moment from 'moment';

//Vform
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


Vue.component('pagination',require('laravel-vue-pagination'));


//Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

//Vue progressBar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

//VueRouter
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const DashboardIndex = require('./components/dashboard/Index.vue').default;
const DeveloperIndex = require('./components/developer/Index.vue').default;
const ProfileIndex = require('./components/profile/Index.vue').default;
const UserIndex = require('./components/users/Index.vue').default;
const NotFound = require('./components/errors/NotFound.vue').default;

const routes =[
    {
        path:'/dashboard',
        name: 'dashboard.Index.vue',
        component : DashboardIndex
    },
    {
        path:'/developer',
        name: 'developer.Index.vue',
        component : DeveloperIndex
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
    },
    {
        path:'*',
        component : NotFound
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.filter('upText',function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(dates){
    return moment(dates).format('MMMM Do YYYY');
});

window.Fire = new Vue();


Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'not-found',
    require('./components/errors/NotFound').default
);

const app = new Vue({
    el: '#app',
    router,
    data:{
        search:''
    },
    methods:{
        searchit: _.debounce(()=>{
            Fire.$emit('searching');
        },1000)
    }
});
