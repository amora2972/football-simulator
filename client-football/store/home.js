export const state = () => ({
    home: {}
})

export const actions = {
    async init({ commit }) {
        const response = await this.$axios.get('home')
        commit('weeks/setWeeks', response.weeks, { root: true })
        commit('teams/setTeams', response.teams, { root: true })
        return commit('matches/setAllPlayed', response.did_play_all, { root: true })
    },
}

export const mutations = {
  setMatches(state, data) {
      return state.list = data
  },
  setActiveMatches(state, data) {
      return state.activeMatches = data
  },
  setAllPlayed(state, data) {
      return state.allPlayed = data
  },
  setPlayAll(state, data) {
    return state.playAll = data
  }
}
