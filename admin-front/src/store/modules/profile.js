import axios from 'axios';

const state = {
  userData: [],
};

const getters = {
  userName: state => (state.userData.name)?state.userData.name:state.userData.email,
  userType: state => (state.userData.account_status === '0')?'Администратор':'Пользователь',
};

const mutations = {
  setUserData(state, payload) {
    state.userData = payload.userData;
  },
};

const actions = {
  setUserData(context) {
    if (localStorage.getItem('access_token') !== null){
      const options = {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        url: 'http://api.gifkawood.ru/api/getUserData',
      };
      axios(options)
        .then(response => {
          console.log(response.data);
          context.commit('setUserData', { userData: response.data });
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
