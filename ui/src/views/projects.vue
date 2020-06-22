<template lang="html">
  <div>
    <template v-if="selected">
      <project :project="selected"/>
    </template>
    <div v-else class="project-list">
      <div v-if="!projects" class="loading">
        Loading...
      </div>
      <template v-else>
        <b-button block variant="primary" class="mb-4" :disabled="is_creating" @click="create()">
          Create new project
        </b-button>
        <b-button block class="project" @click="open(proj)" v-for="proj in projects" :key="proj.id">
          <!-- <span class="float-left"> -->
            <!-- &lt;&lt;- -->
          <!-- </span> -->
          {{ proj.name }}
          <!-- <span class="float-right"> -->
            <!-- --&gt; -->
          <!-- </span> -->
        </b-button>
      </template>
    </div>
  </div>
</template>

<script>
import project from './project'
export default {
  components: {
    project,
  },

  data () {
    return {
      projects: null,
      is_creating: false,
    }
  },

  computed: {
    selected () {
      return (this.projects || []).find(x => x.id == this.$route.params.id)
    },
  },

  created () {
    this.refresh()
    this._int = setInterval(() => this.refresh(), 2000)
  },

  beforeDestroy () {
    clearInterval(this._int)
  },

  methods: {
    refresh () {
      this.$http.get('projects')
      .then(res => {
        this.projects = res.data
      })
    },

    create () {
      this.is_creating = true
      let data = {
        name: 'Project #'+(this.projects.length+1),
        config: {},
      }
      this.$http.post('projects', data)
      .then(res => {
        this.projects.unshift(res.data)
        this.$router.push({
          params: { id: res.data.id },
        })
      })
      .finally(() => {
        this.is_creating = false
      })
    },

    open (proj) {
      this.$router.push({
        params: { id: proj.id },
      })
    },
  }
}
</script>

<style lang="scss">
.project-list {
  padding: 0 2rem;
  max-width: 20rem;
  margin: 0 auto;
  .project {
    margin: 1rem 0;
    // border: 2px solid transparent!important;
    border-color: transparent;
    // padding: 1rem;
    background: transparent;
    &:hover {
      border-color: var(--primary);
      // background: var(--primary);
      color: var(--primary);
    }
  }
}
</style>
