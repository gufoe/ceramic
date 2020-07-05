<template lang="html">
  <b-container class="home-page py-5">
    <div style="margin: 5vh 0 7vh">
      <h1><b>Ceramic</b></h1>
      <h3 class=" lh-15">Convert your <b>HTML</b> assets into an <b>APK</b></h3>
      <h5 class="mb-0">with Capacitor</h5>
    </div>

    <b-row>
      <b-col v-for="feat in features" :key="feat.title" :class="'feature -text-'+feat.variant" sm="6">
        <h4 :class="'mb-3 bold text-'+feat.variant">
          <b-icon :icon="feat.icon" :variant="feat.variant" :animation="feat.animation" class="mr-2"/>
          {{ feat.title }}
        </h4>
        <p v-html="feat.description"/>
        <b-button :variant="feat.variant" @click="feat.action_fn">{{ feat.action }}</b-button>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data () {
    return {
      features: [
        {
          variant: 'success',
          icon: 'clipboard-data',
          title: 'No pain',
          description: 'Just create a project and upload a zip file with a index.html and the other assets, wait a few seconds and download your APK',
          action: 'I want to sign in',
          action_fn: () => {
            this.$router.push({
              name: 'login',
            })
          },
        },
        {
          variant: 'warning',
          icon: 'terminal',
          // icon: 'gear-fill',
          // animation: 'spin',
          title: 'No humans',
          description: 'We have the CLI support, so you can automate everybody from the terminal.',
          action: 'I want to sign up',
          action_fn: () => {
            this.$router.push({
              name: 'signup',
            })
          },
        },
        {
          variant: 'danger',
          icon: 'shield-lock',
          title: 'Secure APIs',
          description: 'Use our JSON APIs for whatever you like. The cli uses them. ',
          action: 'I want to do nothing.',
          action_fn: () => {
            alert('Ok.')
          },
        },
        {
          variant: 'info',
          icon: 'info-circle',
          title: 'About',
          description: 'I hate installing and using android studio for my web apps so fuck it i made this service inspired by PhoneGap.<br>My name is Giacomo Rizzi (aka <b><a href="https://t.me/gufoe">@gufoe</a></b>)',
          action: 'Text me',
          action_fn: () => {
            location.href = "https://t.me/gufoe"
          },
        },
      ]
    }
  }
}
</script>

<style lang="scss">
.home-page {
  text-align: center;
  .feature {
    margin: 0 auto 3rem;
    max-width: 30rem;

    p {
      transition: .3s;
      opacity: .7;
    }

    &:hover {
      p {
        opacity: 1;
      }
    }
  }
}
</style>
