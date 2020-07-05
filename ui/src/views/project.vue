<template lang="html">
  <div class="project-page">
    <h1>{{ project.name }}</h1>
    <h5>Secret: <code>{{ project.secret }}</code></h5>
    <div class="mt-4">

      <b-form @submit.prevent="startBuild()" ref="build_form">
        <b-row>
          <b-col style="flex-grow: 10">
            <b-form-file accept=".zip"
              v-model="build_form.file"
              placeholder="Select your project">
            </b-form-file>
          </b-col>
          <b-col>
            <b-button type="submit" variant="primary" :disabled="!build_form.file">
              Upload
            </b-button>
          </b-col>
        </b-row>
      </b-form>
      <div>
        <!-- <thead>
          <tr>
            <th>Status</th>
            <th>Time</th>
            <th>Actions</th>
          </tr>
        </thead> -->
        <div class="builds-table my-5">
          <div v-for="(build, build_i) in project.builds" :key="build.id" :old="build_i>0" class="row">
            <div class="col-6 col-md-4 state">
              <div>
                <b-icon-award v-if="build.status == 'built'"/>
                <b-icon-gear-fill v-else-if="build.status == 'building'" animation="spin"/>
                <b-icon-alarm-fill v-else-if="build.status == 'pending'" animation="fade"/>
                <b-icon-exclamation-triangle-fill v-else-if="build.status == 'failed'"/>
                <b-icon-trash-fill v-else-if="build.status == 'canceled'"/>
                <span class="ml-2">
                  {{ $t(`build_status.${build.status}`) }}
                </span>
              </div>
            </div>
            <div class="col-6 col-md-4 time">
              <b-icon-clock class="mr-2"/>
              <timeago :datetime="$utc(build.created_at)" :autoUpdate="true"/>
            </div>
            <div class="col-12 col-md-4 text-right">
              <b-button v-if="build.status == 'built'"
              v-b-tooltip.hover.bottom title="Download debug apk"
              variant="link"
              :href="$store.linkTo(build.id+'-debug.apk')" :download="`${project.name}.apk`">
                <b-icon-file-earmark-code/>
              </b-button>
              <b-button v-if="build.status == 'built'"
              v-b-tooltip.hover.bottom title="Download release apk"
              variant="link"
              :href="$store.linkTo(build.id+'-release.apk')" :download="`${project.name}.apk`">
                <b-icon-file-earmark-check/>
              </b-button>
              <b-button variant="link"
              v-b-tooltip.hover.bottom title="Download source code"
              :href="$store.linkTo(build.input+'.zip')" :download="`${project.name}.zip`">
                <b-icon-file-earmark-zip/>
              </b-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    project: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      build_form: {
        file: null,
      },
    }
  },

  methods: {
    startBuild() {
      let data = new FormData()
      for (var i in this.build_form) {
        data.append(i, this.build_form[i])
      }
      this.$http.post(`projects/${this.project.id}/build`, data)
        .then(res => {
          this.project.builds.unshift(res.data)
        })
    },
  },

}
</script>

<style lang="scss">
.tooltip.b-tooltip .arrow {
    display: none!important;
}
.project-page {
    max-width: 50rem;
    padding: 0 2rem;
    margin: 0 auto;

    .builds-table {
      .row {
        align-items: center;
        border-radius: 1rem;
        padding: 1rem;
        transition: .1s;
        &[old] {
          opacity: .4;
        }
        &:hover {
          background: rgba(255, 255, 255, .05);
        }
      }
      .btn {
        padding: 1rem;
        &:hover {
          color: var(--light);
        }
      }
    }
}
</style>
