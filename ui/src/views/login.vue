<template lang="html">
  <div class="page-login">
    <h1>Log in</h1>
    <div class="text-danger" v-if="errors">
      Login failed
    </div>
    <b-form class="mt-4">
      <b-form-group>
      <b-input-group size="sm">
        <b-input-group-prepend is-text>
          <b-icon-person-fill/>
        </b-input-group-prepend>
        <b-form-input v-model="form.email"
          type="email"
          trim
          placeholder="Email"
          autofocus/>
        </b-input-group>
      </b-form-group>
      <b-form-group>
        <b-input-group size="sm" class="mb-2">
          <b-input-group-prepend is-text>
            <b-icon-lock-fill/>
          </b-input-group-prepend>
          <b-form-input v-model="form.password"
            type="password"
            placeholder="Password" />
        </b-input-group>
      </b-form-group>

      <div class="mt-4">
        <b-button variant="primary" :disabled="is_loading" @click="login()">Log in</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      form: {
      },
      errors: false,
      is_loading: false,
    }
  },

  methods: {
    login () {
      this.errors = null
      this.is_loading = true
      this.$http.post('login', this.form)
      .then(res => {
        this.$store.user = res.data.user
        this.$store.token = res.data.token
        this.$router.push({name:'projects'})
      }, err => {
        console.log(err.response)
        if (err.response && [401, 404].includes(err.response.status)) {
          this.errors = err.response.data
        }
      }).finally(() => {
        this.is_loading = false
      })
    },
  }
}
</script>

<style lang="scss">
.page-login {
  max-width: 20rem;
  margin: 0 auto;
}
</style>
