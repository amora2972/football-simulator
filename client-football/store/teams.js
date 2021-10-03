export const state = () => ({
  list: []
})

export const getters = {
    teams(state) {
        return state.list
    }
}

export const actions = {
    async fetchAll({ commit }) {
        const teams = await this.$axios.get('teams')
        return commit('setTeams', teams)
    }
}

export const mutations = {
  setTeams(state, data) {
      return state.list = data
  }
}
