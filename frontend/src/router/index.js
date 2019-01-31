import Router from 'vue-router'

// Containers
const DefaultContainer = () => import('@/containers/DefaultContainer');

const Files = () => import('@/views/files/Files');
const Login = () => import('@/views/login/Login');
const MainPage = () => import('@/views/mainPage/MainPage');

//main

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      redirect: '/main',
      name: 'Home',
      component: DefaultContainer,
      children: [
        {
          path: 'files',
          name: 'Files',
          component: Files,
          meta: {
            requiresAuth: true
          },
        },
      ]
    },{
      path: '/main',
      name: 'MainPage',
      component: MainPage,
      meta: {
        requiresAuth: true
      },
    },
    {
      path: '/login',
      name: 'Login',
      meta: {
        requiresAuth: false
      },
      component: Login,
    },
  ]
})
