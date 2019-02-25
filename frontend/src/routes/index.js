import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/login',
      component: require('./views/auth/Login.vue').default,
    },
    {
      path: '/',
      component: require('./layouts/BackendLayout.vue').default,
      children: [
        {
          path: '/',
          name: 'backend.index',
          component: require('./views/BackendIndex.vue').default,
          meta: {
            breadcrumb: {
              text: '首頁'
            }
          }
        },
        {
          path: '/product',
          name: 'product.list',
          component: require('./views/product/List.vue').default,
          meta: {
            breadcrumb: {
              text: '產品'
            }
          }
        },
        {
          path: '/product/:id',
          name: 'product.edit',
          component: require('./views/product/Edit.vue').default,
          meta: {
            breadcrumb: {
              text: '編輯'
            }
          }
        }
      ]
    },{
      path: '/pos',
      component: require('./layouts/PosLayout.vue').default,
      children: [
        {
          path: '/',
          name: 'pos.index',
          component: require('./views/PosIndex.vue').default
        },
      ]
    }
  ]
})
