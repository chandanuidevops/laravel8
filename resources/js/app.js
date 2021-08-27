/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

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
});

require('tinymce/themes/silver');
require('tinymce/icons/default');
require('tinymce/plugins/image');
require('tinymce/plugins/code');
import axios from 'axios';
import tinymce from 'tinymce';
tinymce.init({
    selector:'textarea',
    height:300,
    skin:false,
    content_css:false,
    plugins:'code image',
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    images_upload_url: 'postAcceptor.php',
    /* we override default upload handler to simulate successful upload*/
    images_upload_handler: function (blobInfo, success, failure) {
       let formData= new FormData();
       formData.append('file',blobInfo.blob());
       axios.post('/admin/upload',formData)
        .then(function(res){
            success(res.data.location);
        })
    },
})