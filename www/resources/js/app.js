import VueI18n from 'vue-i18n'
import messages from './messages'

require('./bootstrap');
window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


// Create VueI18n instance with options
const i18n = new VueI18n({
  locale: 'it', // set locale
  messages, // set locale messages
})


Vue.prototype.$utc = str => {
  if (!str || typeof str != 'string') return new Date()
  let pieces = str.match(/\d+/g)
  // console.log(pieces)
  return new Date(Date.UTC(Number(pieces[0]), Number(pieces[1])-1, Number(pieces[2]),
      Number(pieces[3]), Number(pieces[4]), Number(pieces[5])))
}

const app = new Vue({
    i18n,
    el: '#app',
})
