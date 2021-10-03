export const state = () => ({
  list: [],
  predictions: [],
})

export const getters = {
    standings(state) {
        return state.list
    },
    predictions(state) {
        return state.predictions
    }
}

export const actions = {
    async fetchAll({ commit }) {
        const standings = await this.$axios.get('standings')

        return commit('setStandings', standings)
    },
    async predict({commit}) {
        const predictions = await this.$axios.get('matches/left/predict')

        return commit('setPredictions', predictions)
    }
}

export const mutations = {
  setStandings(state, data) {
      return state.list = data
  },
  setPredictions(state, data) {
      return state.predictions = data
  }
}
