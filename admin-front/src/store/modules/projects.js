import axios from 'axios';

const state = {
  projects: [],
};

const getters = {
  projects: state => state.projects,
};

const mutations = {
  setProjects(state, payload) {
    state.projects = payload.projects;
  },
};

const actions = {
  setProjects(context) {
    if (localStorage.getItem('access_token') !== null){
      const options = {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        url: 'http://api.gifkawood.ru/api/getProjects',
      };
      axios(options)
        .then(response => {
          console.log(response.data);
          // context.commit('setProjects', { projects: response.data });
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
