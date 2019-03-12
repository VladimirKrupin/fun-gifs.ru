import axios from 'axios';

const state = {
  posts: [],
};

const getters = {
  posts: state => state.posts,
};

const mutations = {
  setPosts(state, payload) {
    state.posts = payload.posts;
  },
};

const actions = {
  setPosts(context) {
    if (localStorage.getItem('access_token') !== null){
      const options = {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        url: 'http://api.fun-gifs.ru/api/getPosts/',
      };
      axios(options)
        .then(response => {
          context.commit('setPosts', { posts: response.data.posts });
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
