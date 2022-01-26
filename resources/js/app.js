require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('AppHome', require('./components/AppHome.vue').default);

import Vue from 'vue'
import Vuetify from 'vuetify'
import User from './Helpers/User'
import router from './router/router'

Vue.use(Vuetify)

const vuetify = new Vuetify();
window.User = User
window.EventBus = new Vue();

const app = new Vue({
    el: '#app',
    vuetify,
    router
});
