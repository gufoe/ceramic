<template lang="html">
  <div class="">
    Logging you out...
  </div>
</template>

<script>
export default {
  data () {
    return {
    }
  },

  created () {
    this.$http.post('logout')
    .then(() => {
      this.$store.user = null
      this.$store.token = null
      this.$router.push({name:'home'})
    })
  },
}
</script>

<style lang="scss">
</style>
