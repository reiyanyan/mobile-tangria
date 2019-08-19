
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(Vuetify, axios, VueAxios);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('toolbar', require('./components/scaffold/ToolbarComponent.vue').default);
Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('login', require('./components/auth/Login.vue').default);
Vue.component('register', require('./components/auth/Register.vue').default);
Vue.component('home', require('./components/Home.vue').default);
Vue.component('info', require('./components/Info.vue').default);
Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('booking', require('./components/Booking.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        guest: localStorage.getItem('guest'),
        current_url: window.location.pathname,
    },
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        }
    },
    methods: {
        logout() {
            document.getElementById('logout-form').submit()
        }
    },
});
