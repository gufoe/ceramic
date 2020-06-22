import Vue from 'vue'
import App from './App.vue'
import lodash from 'lodash'
import axios from 'axios'
import router from './router.js'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import './theme.scss'
import VueI18n from 'vue-i18n'
import en from './i18n/en'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.config.productionTip = false

Vue.prototype._ = window._ = lodash
Vue.prototype.$http = axios.create({
  baseURL: '//'+location.hostname+'/api/',
  timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
})


Vue.prototype.$utc = str => {
  if (!str || typeof str != 'string') return new Date()
  let pieces = str.match(/\d+/g)
  // console.log(pieces)
  return new Date(Date.UTC(Number(pieces[0]), Number(pieces[1])-1, Number(pieces[2]),
      Number(pieces[3]), Number(pieces[4]), Number(pieces[5])))
}

Vue.use(VueI18n)
let i18n = new VueI18n({
  locale: 'en',
  messages: { en },
  dateTimeFormats: {
    en: {
      short: {
        year: 'numeric', month: 'short', day: 'numeric'
      },
      long: {
        year: 'numeric', month: 'short', day: 'numeric',
        weekday: 'short', hour: 'numeric', minute: 'numeric'
      }
    },
  }
})


import VueTimeago from 'vue-timeago'
Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'en', // Default locale
  locales: { }
})

new Vue({
  router,
  render: h => h(App),
  i18n,
}).$mount('#app')
