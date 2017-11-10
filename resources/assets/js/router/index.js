import Vue from 'vue'
import Router from 'vue-router'

import HomePage from '@/components/homePage/Index'
import Wiznote from '@/components/wiznote/Index'

Vue.use(Router)

export default new Router({
  history: 'true',
  routes: [
    {
      path: '/',
      component: HomePage
    },
    {
      path: '/note',
      component: Wiznote
    },
    {
      path: '/note/:id',
      component: Wiznote
    }
  ]
})