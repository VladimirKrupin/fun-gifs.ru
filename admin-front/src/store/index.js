import Vuex from "vuex";
import Vue from 'vue'
import profile from './modules/profile'
import posting from './modules/posting'
import projects from './modules/projects'

Vue.use(Vuex);

export const store = new Vuex.Store({
  strict: true,
  modules: {
    posting,
    profile,
    projects,
  }
});
