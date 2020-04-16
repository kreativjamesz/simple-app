import Vue from 'vue';
//window.Vue = require('vue');
import VueRouter from 'vue-router';
require('./bootstrap');
import routes from './routes';


Vue.use(VueRouter);


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
