import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
require('./bootstrap');

Vue.use(VueRouter);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});



///////////////////////////////////////////////////////////////////////////////////////////
ClassicEditor.create( document.querySelector( '#editor' ), {
}).then( editor => {
    console.log( 'Editor was initialized', editor );
    const toolbarContainer = document.querySelector( '#toolbar-container' );
    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
}).catch( error => {
        console.error( error.stack );
});
