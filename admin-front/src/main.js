import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'
import 'es6-promise/auto';
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import router from './router/index'
import Auth from "./plugins/Auth";
import { store } from './store'
import VueRouter from 'vue-router';

Vue.use(BootstrapVue);
Vue.use(Auth);
Vue.use(VueRouter);

require('./config/guards');

store.dispatch('posting/setPosts');
store.dispatch('profile/setUserData');
store.dispatch('projects/setProjects');
store.dispatch('projects/setItems');

new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {
    App
  },
});
