import Vue from 'vue'
import Router from 'vue-router'

import Home from '@/components/HomeHorizontal'
import Wiz from '@/components/Wiz'
import Note from '@/components/Note'

Vue.use(Router)

export default new Router({
  history: 'true',
  routes: [
    {
      path: '/',
      component: Home,
      redirect: '/wiz',
      children: [
        {
          path: '/wiz',
          component: Wiz,
          children:[
            {
              path: '/',
              component: Note
            },          
            {
              path: ':id',
              component: Note
            }
          ]
        }        
      ]
    },   
  ]
})