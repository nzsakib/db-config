window.Vue = require('vue');

window.axios = require('axios');

window._ = require('lodash');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.events = new Vue();

// window.flash = function (message) {
//     window.events.$emit('flash', message);
// };

// Vue.component('add-product', require('./components/vue/addProduct.vue').default);

const app = new Vue({
    el: '#app'
});