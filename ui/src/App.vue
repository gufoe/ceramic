<template>
  <div id="app">
    <div v-if="is_loading">
      Loading user data...
    </div>
    <template v-else>
      <xmenu/>
      <router-view/>
    </template>

  </div>
</template>
<script type="text/javascript">
import Vue from 'vue'
import xmenu from './components/menu.vue'
export default {
  components: {
    xmenu,
  },
  data () {
    return {
      user: null,
      token: localStorage.token,
    }
  },
  computed: {
    is_loading () {
      return this.token && !this.user
    },
  },

  created () {
    Vue.prototype.$store = this

    this.$http.interceptors.request.use(config => {
      if (this.token) {
        config.headers.common.Authorization = 'bearer '+this.token
      }
      return config
    }, error => {
      return Promise.reject(error)
    })

    this.refreshUser()

  },

  methods: {
    linkTo (file) {
      return '//'+location.hostname+'/storage/'+file
    },
    refreshUser () {
      if (!this.token) {
        this.user = null
      } else {
        this.$http.get('self')
        .then(res => {
          this.user = res.data
        }, err => {
          console.log(err.response)
          if (err.response && err.response.status == 401) {
            this.user = null
            this.token = null
          } else {
            setTimeout(() => this.refreshUser(), 2000)
          }
        })
      }
    },
  },

  watch: {
    token (token) {
      if (!token) {
        localStorage.removeItem('token')
      } else {
        localStorage.token = token
      }
    },
  },
}
</script>
<style lang="scss">
</style>
