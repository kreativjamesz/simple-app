require('./bootstrap');
// import VueRouter from 'vue-router';
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

window.Vue = require('vue');

// Vue.use(VueRouter);


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('userinfo', require('./components/UserInfo.vue').default);

let app = new Vue({
    el: '#app',
    // router: new VueRouter(routes)
});

// For WYSIWYG
// ClassicEditor.create( document.querySelector( '#editor' ), {
    
// })
// .then( editor => {
//     console.log( 'Editor was initialized', editor );
//     const toolbarContainer = document.querySelector( '#toolbar-container' );
//     toolbarContainer.appendChild( editor.ui.view.toolbar.element );
// })
// .catch( error => {
//     console.error( error.stack );
// });
