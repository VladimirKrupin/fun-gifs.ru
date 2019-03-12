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
          console.log(response);
          if (response.data.status === 'ok'){
            context.commit('setPosts', { posts: response.data.data.posts });
          }else if (response.data.status === 'error') {
            console.log(response.data.data.error);
          }
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
