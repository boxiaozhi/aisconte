import Vue from 'vue'
import Router from 'vue-router'

import HomePage from '@/components/homePage/Index'
import Note from '@/components/note/Index'

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
      component: Note
    },
    {
      path: '/note/:id',
      component: Note
    }
  ]
})