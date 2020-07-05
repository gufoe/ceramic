<template lang="html">
  <b-nav pills>
    <b-nav-item v-for="route in routes" :href="$router.resolve(route).href" :key="route.name" :active="$route.name == route.name">
      {{ route.label }}
    </b-nav-item>
  </b-nav>
</template>

<script>
export default {
  computed: {
    routes () {
      let ret = []
      ret.push({
        name: 'home',
        label: 'Home',
      })
      if (!this.$store.token) {
        ret.push({
          name: 'login',
          label: 'Login',
        })
        ret.push({
          name: 'signup',
          label: 'Signup',
        })
      } else {
        ret.push({
          name: 'projects',
          label: 'Projects',
        })
        ret.push({
          name: 'logout',
          label: 'Logout',
        })
      }
      return ret
    }
  }
}
</script>

<style lang="scss">
.nav {
  // background: var(--dark);
  justify-content: center;
  align-items: center;
  border-bottom: 1px solid var(--primary);
  margin-bottom: 2rem!important;
  // height: 2.7rem;
  .nav-link {
    width: 7rem;
    text-align: center;
    outline: none;
    border-radius: 0!important;
    transition: .4s;
    &.active {
      // font-size: 1.1rem;
    }
  }
}
</style>
