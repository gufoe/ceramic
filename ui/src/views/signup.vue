<template lang="html">
  <div class="page-signup">
    <h1>Sign up</h1>
    <b-form class="mt-4" @click="signup()">
      <b-form-group
      :invalid-feedback="errors ? (errors.response.email||[]).join(' ') : ''"
      :state="errors ? !errors.response.email : null">
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
      <b-form-group
      :invalid-feedback="errors ? (errors.response.password||[]).join(' ') : ''"
      :state="errors ? !errors.response.password : null">
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
        <b-button variant="primary" :disabled="is_loading" type="submit">Register</b-button>
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
      errors: null,
      is_loading: false,
    }
  },

  methods: {
    signup () {
      this.errors = null
      this.is_loading = true
      this.$http.post('signup', this.form)
      .then(res => {
        this.$store.user = res.data.user
        this.$store.token = res.data.token
        this.$router.push({name:'projects'})
      }, err => {
        console.log(err.response)
        if (err.response && [400].includes(err.response.status)) {
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
.page-signup {
  max-width: 20rem;
  margin: 0 auto;
}
</style>
