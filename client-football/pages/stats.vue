<template>
<div>
  <div v-for="week in weeks" :key="week.id">
    <h2 class="font-bold font-2xl">{{ week.name }}</h2>
    <Match v-for="match in week.matches" :match="match" :key="match.id"/>
  </div>
  <Standing/>
  <nuxt-link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" to='/'>Go Back Home</nuxt-link>
</div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  computed: {
    ...mapGetters('weeks', ['weeks'])
  },
  created() {
    this.$store.dispatch('weeks/fetchAll')
  }
}
</script>
