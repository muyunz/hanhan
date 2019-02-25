import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'

import PosLayout from './layouts/PosLayout.vue'
import PosIndex from './views/PosIndex.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },{
      path: '/pos',
      component: PosLayout,
      children: [
        {
          path: '/',
          name: 'pos.index',
          component: PosIndex
        }
      ]
    }
  ]
})
