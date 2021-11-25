/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import BootstrapVue from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(BootstrapVue)
Vue.use(VueSweetalert2);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('datatable-component', require('./components/DatatableComponent.vue').default);
Vue.component('c-shipper-component', require('./components/CreateShipperFormComponent.vue').default);
Vue.component('c-address-component', require('./components/CreateAddressComponent.vue').default);
Vue.component('d-address-component', require('./components/DeleteAddressComponent.vue').default);
Vue.component('e-address-component', require('./components/EditAddressComponent.vue').default);
Vue.component('c-contact-component', require('./components/CreateContactComponent.vue').default);
Vue.component('d-contact-component', require('./components/DeleteContactComponent.vue').default);
Vue.component('e-contact-component', require('./components/EditContactComponent.vue').default);
Vue.component('e-company-component', require('./components/EditCompanyComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
