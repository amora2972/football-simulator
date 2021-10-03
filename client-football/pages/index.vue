<template>
    <div class="flex flex-col">
      <Team v-for="team in teams" :team="team" :key="team.id"/>

      <div v-if="! allPlayed" class="flex flex-row">
        <button @click.prevent="playAll" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2 w-full">Play All</button>
        <button @click.prevent="generateFixture" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Start Fixture</button>
      </div>
      <div v-else>
        <button @click.prevent="reset" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reset</button>
      </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  computed: {
    ...mapGetters('teams', ['teams']),
    ...mapGetters('weeks', ['weeks']),
    ...mapGetters('matches', ['allPlayed'])
  },
  created() {
    this.$store.dispatch('home/init')
  },
  methods: {
    async generateFixture() {
      await this.$store.dispatch('matches/generate');
      this.$router.push('/matches/' + this.weeks[0].id)
    },
    reset() {
      this.$store.dispatch('matches/reset')
    },
    async playAll() {
      await this.$store.commit('matches/setPlayAll', true)
      this.generateFixture()
    }
  }
}
</script>
