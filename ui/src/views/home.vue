<template lang="html">
  <b-container>
    <h1>Ceramic</h1>
    <h3>Convert your assets into an app thanks to Capacitor</h3>

    <b-row class="mt-5">
      <b-col v-for="feat in features" :key="feat.title" class="feature">
        <h4>
          <b-icon :icon="feat.icon" :variant="feat.variant" :animation="feat.animation"/>
          {{ feat.title }}
        </h4>
        <p v-html="feat.description"></p>
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
          variant: 'primary',
          icon: 'layers',
          title: 'Take advantage of the strengths of Capacitor.',
          description: 'Build great apps powered by open web standards. Cut down on development time by re-using your existing web dev skills, frameworks and tools. Get all the benefits of cross-platform development while building apps just the way you like.',
        },
        {
          variant: 'primary',
          icon: 'gear-fill',
          animation: 'spin',
          title: 'We compile for you.',
          description: 'Get app-store ready apps without the headache of maintaining native SDKs. We do the work for you in the cloud and your app will always be built with the most up-to-date SDK for the platform you are targeting.',
        },
        {
          variant: 'primary',
          icon: 'alarm',
          title: 'Quick deployment cycles.',
          description: 'Use the Hydration feature to get faster debug and build cycles. By compiling builds faster, your updates will be pushed directly to your testers\' previously installed apps, ensuring everyone is working on the most up-to-date version.',
        },
      ]
    }
  }
}
</script>

<style lang="scss">
.feature {
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
</style>
