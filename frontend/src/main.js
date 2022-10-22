import Vue from 'vue'
import axios from './lib/axios'
import App from './App.vue'

Vue.config.productionTip = false

new Vue({
  axios,
  render: h => h(App)
}).$mount('#app')
