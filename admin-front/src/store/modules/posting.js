import axios from 'axios';

const state = {
  gifkawood: [],
  moregirls: [],
  postsError: '',
};

const getters = {
  gifkawood: state => state.gifkawood,
  moregirls: state => state.moregirls,
  postsError: state => state.postsError,
};

const mutations = {
  setGifkawood(state, payload) {
    state.gifkawood = payload.posts;
  },
  setMoregirls(state, payload) {
    state.moregirls = payload.posts;
  },
  setPostsError(state, payload) {
    state.postsError = payload.postsError;
  },
};

const actions = {
  setPosts(context,payload) {
    if (localStorage.getItem('access_token') !== null){
      const options = {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        url: 'http://api.gifkawood.ru/api/getPosts',
      };
      axios(options)
        .then(response => {
          console.log(response);
          if (response.data.status === 'ok'){
            context.commit('setGifkawood', { posts: response.data.data.gifkawood });
            context.commit('setMoregirls', { posts: response.data.data.moregirls });
          }else if (response.data.status === 'error') {
            context.commit('setPostsError', { postsError: response.data.data.error });
            console.log(response.data);
          }
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
