import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './components'

import iView from 'iview';
import 'iview/dist/styles/iview.css';
import './theme/dist/iview.css';
import './styles/app.scss';
Vue.use(iView, {
  transfer: true,
});

import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

import ValidatePlugin from './plugins/validate'
Vue.use(ValidatePlugin);


import Vue2TouchEvents from 'vue2-touch-events'
Vue.use(Vue2TouchEvents)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
