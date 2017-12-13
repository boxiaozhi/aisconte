import Vue from 'vue'
import Router from 'vue-router'

import Home from '@/components/home/Index'
import Note from '@/components/note/Index'

Vue.use(Router)

export default new Router({
  history: 'true',
  routes: [
    {
      path: '/',
      component: Home
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