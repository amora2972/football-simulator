<template>
  <div class="flex flex-col">
    <div v-for="activeMatch in activeMatches" :key="activeMatch.id">
      <Match :match="activeMatch"/>
    </div>
    <div class="flex flex-row justify-evenly">
      <Standing v-if="activeMatches.length"/>
      <Prediction v-if="predictions.length && teams.length && currentWeek >= 4" :week="currentWeek"/>
    </div>
    <button v-if="isThereNextWeek && ! playAll" @click.prevent="pushNextWeek" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next Week</button>
    <button v-else-if="! playAll" @click.prevent="displayStats" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Stats</button>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import Standing from '../../components/Standing'
import Prediction from '../../components/Prediction'

export default {
  components:{Standing, Prediction},
  computed: {
    ...mapGetters('matches', ['activeMatches']),
    ...mapGetters('weeks', ['weeks']),
    ...mapGetters('standings', ['predictions']),
    ...mapGetters('teams', ['teams']),
    ...mapGetters('matches', ['playAll']),
    currentWeek() {
      return this.$route.params.week
    },
    isThereNextWeek() {
      let index = this.nextWeek

      if (index !== -1) {
          return true
      }

      return false
    },
    nextWeek() {
      let index = this.weeks.findIndex((week) => week.id == this.$route.params.week)
      if (index !== -1 && typeof this.weeks[index + 1] !== 'undefined') {
          return this.weeks[index + 1]
      }
      return -1
    }
  },
  created() {
    if (! this.weeks.length) {
      this.$store.dispatch('weeks/fetchAll')
    }

    // TODO:: check if already played
    this.$store.dispatch('matches/play', this.$route.params.week)

    if (this.$route.params.week >= 4) {
      this.$store.dispatch('standings/predict')
      if (this.teams.length === 0) {
        this.$store.dispatch('teams/fetchAll')
      }
    }

    if (this.playAll && this.nextWeek != -1) {
      setTimeout(() => {
        this.pushNextWeek()
      }, 3000)
    } else if (this.nextWeek == -1 && this.playAll) {
      setTimeout(() => {
        this.displayStats()
      }, 3000)
    }
  },
  methods: {
    pushNextWeek() {
      this.$router.push('/matches/' + this.nextWeek.id)
    },
    displayStats() {
      this.$router.push('/stats')
    }
  },
};
</script>
