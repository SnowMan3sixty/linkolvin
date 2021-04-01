import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueCookies from 'vue-cookies'
import VueSession from 'vue-session'

import App from './App.vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueAxios, axios)

Vue.use(VueCookies)

Vue.use(VueSession)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')

// new Vue({
//   el:'#btn-exit',
//   data:function() {
//     return {
      
//     }
//   },
//   delete: function() {
//    this.$cookies.set('auth_token','authentication',"1d");
//    console.log(this.$cookies.isKey('auth_token'));
//   //  console.log( this.$cookies.remove('auth_token'));
//   //  console.log(this.$cookies.isKey('auth_token'));
//   }
// })