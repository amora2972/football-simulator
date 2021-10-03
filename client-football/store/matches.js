export const state = () => ({
  list: [],
  activeMatches: {},
  allPlayed: false,
  playAll: false,
})

export const getters = {
    all(state) {
        return state.list
    },
    activeMatches(state) {
        return state.activeMatches
    },
    allPlayed(state) {
        return state.allPlayed
    },
    playAll(state) {
        return state.playAll
    }
}

export const actions = {
    async generate({ commit }) {
        const matches = await this.$axios.post('matches/generate')
        return commit('setMatches', matches)
    },
    async week({commit}, id) {
        const matches = await this.$axios.get('matches/' + id)
        return commit('setActiveMatches', matches)
    },
    async play({commit}, id) {
        commit('setActiveMatches', {})
        const matches = await this.$axios.post('matches/play/' + id)
        return commit('setActiveMatches', matches)
    },
    async allPlayed({commit}) {
        const allPlayed = await this.$axios.get('matches/played/all')
        return commit('setAllPlayed', allPlayed.did_play_all)
    },
    async reset({commit}) {
        await this.$axios.post('matches/reset')
        commit('setActiveMatches', {})
        commit('setMatches', [])
        commit('setPlayAll', false)
        return commit('setAllPlayed', false)
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
