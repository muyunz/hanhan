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
            breadcrumbs: [
              {
                text: '首頁'
              }
            ]
          }
        },
        {
          path: '/product',
          name: 'product.list',
          component: require('./views/product/List.vue').default,
          meta: {
            breadcrumbs: [
              {
                text: '產品'
              },
              {
                text: '列表'
              }
            ]
          }
        },
        {
          path: '/product/create',
          name: 'product.create',
          component: require('./views/product/Create.vue').default,
          meta: {
            breadcrumbs: [
              {
                text: '產品'
              },
              {
                text: '新增'
              }
            ]
          }
        },
        {
          path: '/product/:id/edit',
          name: 'product.edit',
          component: require('./views/product/Create.vue').default,
          meta: {
            breadcrumbs: [
              {
                text: '產品'
              },
              {
                text: '編輯'
              }
            ]
          }
        },
        {
          path: '/product/:id',
          name: 'product.detail',
          component: require('./views/product/Detail.vue').default,
          meta: {
            breadcrumbs: [
              {
                text: '產品'
              },
              {
                text: '詳細'
              }
            ]
          }
        },
      ]
    },{
      path: '/pos',
      component: require('./layouts/PosLayout.vue').default,
      children: [
        {
          path: '/',
          name: 'pos.index',
          component: require('./views/pos/PosIndex.vue').default
        },
      ]
    }
  ]
})
