
require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


let myheader = require('./components/myheader.vue');
let home = require('./components/home.vue');
let about = require('./components/about.vue');


const routes = [
  { path: '/home', component: home },
  { path: '/about', component: about }
]

const router = new VueRouter({

  routes // short for `routes: routes`
})



const app = new Vue({
    el: '#app',
    router,
    components:{myheader}
});
