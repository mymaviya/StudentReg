/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'));


import onlyInt from 'vue-input-only-number';

Vue.use(onlyInt);

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)


import vueImages from 'vue-images'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [

    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/home', component: require('./components/Dashboard.vue').default },
    { path: '/NewRegistration', component: require('./components/NewReg.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');


var converter = require('number-to-words');

Vue.filter('toWords', function (value) {
if (!value) return '';
return converter.toWords(value);
})


Vue.filter('upCase', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

import moment from 'moment'; //dateModifier
Vue.filter('myDate', function(value){
    return moment(value).format('MMMM Do YYYY');
});

Vue.filter('formatDate', function(value){
    return moment(value).format('DD-MM-YYYY');
});

Vue.filter('dateTime', function(value){
    return moment(value).format('DD-MM-YYYY, h:mm:ss a');
});

Vue.filter('money', function(value, sign = '₹ '){
    if(!value) return 0;
    return sign + (value);
});

import numeral from 'numeral';
//import numFormat from 'vue-filter-number-format';

Vue.filter('numFormat', function(value){
    return numeral(value).format('₹0,0.00');
});

const numWords = require('num-words')
//import numFormat from 'vue-filter-number-format';

Vue.filter('numWords', function(value){
    return numWords(value);
});


// Progress Bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
      },
    autoRevert: true,
})

//Alerts
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    //timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;

window.Fire = new Vue();

//Print
import Vue from 'vue';
import VueHtmlToPaper from 'vue-html-to-paper';

const options = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=no',
    'scrollbars=no'
  ],
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    '../css/print.css',

  ]
}

Vue.use(VueHtmlToPaper, options);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data:{
        search: ''
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        },1000)
    }
});
