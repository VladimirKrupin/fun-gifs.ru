import axios from 'axios';

const state = {
  projects: [],
  items: [],
};

const getters = {
  projects: state => state.projects,
  items: state => state.items,
};

const mutations = {
  setProjects(state, payload) {
    state.projects = payload.projects;
  },
  setItems(state, payload) {
    state.items = payload.items;
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
          context.commit('setProjects', { projects: response.data });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  setItems(context) {
    let items = [
      {
        title: true,
        wrapper: {
          element: '',
          attributes: {}
        }
      },
      {
        name: 'GIFKAWOOD',
        url: 'gifkawood',
        icon: 'icon-star'
      },
      {
        name: 'MOREGIRLS',
        url: 'moregirls',
        icon: 'icon-star'
      },
    ];
    context.commit('setItems', { items: items });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
