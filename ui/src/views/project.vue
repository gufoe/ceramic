<template lang="html">
  <div class="project-page">
    <h1>{{ project.name }}</h1>
    <div>

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

      <div class="builds-table">
        <table>
          <!-- <thead>
            <tr>
              <th>Status</th>
              <th>Time</th>
              <th>Actions</th>
            </tr>
          </thead> -->
          <tbody>
            <tr v-for="(build, build_i) in project.builds" :key="build.id" :old="build_i>0">
              <td class="state">
                <b-icon-award v-if="build.status == 'built'"/>
                <b-icon-gear-fill v-else-if="build.status == 'building'" animation="spin"/>
                <b-icon-alarm-fill v-else-if="build.status == 'pending'" animation="fade"/>
                <b-icon-exclamation-triangle-fill v-else-if="build.status == 'failed'"/>
                <b-icon-trash-fill v-else-if="build.status == 'canceled'"/>
                {{ $t(`build_status.${build.status}`) }}
              </td>
              <td class="time">
                <b-icon-clock/>
                &nbsp;
                <timeago :datetime="$utc(build.created_at)" :autoUpdate="true"/>
              </td>
              <td>
                <div class="text-right">
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
              </td>
            </tr>
          </tbody>
        </table>
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

  data () {
    return {
      build_form: {
        file: null,
      },
    }
  },

  methods: {
    startBuild () {
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
  max-width: 40rem;
  padding: 0 2rem;
  margin: 0 auto;

  .builds-table {
    margin-top: 2rem;
    table {
      width: 100%;
    }
    td {
      transition: .2s;
      padding: 0.3rem 1rem;
      overflow: hidden;
      &.time {
        font-size: 1rem;
      }
    }
    tr {
      transition: .2s;
      &[old] {
        td { opacity: .4; }
      }
      &:hover {
        td { opacity: 1; }
        background: var(--soft-dark);
      }
    }
  }
}
</style>
