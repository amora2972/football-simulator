
export const state = () => ({
  list: []
})

export const getters = {
    weeks(state) {
        return state.list
    }
}

export const actions = {
    async fetchAll({ commit }) {
        const weeks = await this.$axios.get('weeks')

        return commit('setWeeks', weeks)
    }
}

export const mutations = {
  setWeeks(state, data) {
      return state.list = data
  }
}
