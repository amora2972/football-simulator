<template>
  <table
    class="
      w-full
      whitespace-nowrap
      rounded-lg
      bg-white
      divide-y divide-gray-300
      overflow-hidden
      ml-2
    "
  >
    <thead class="bg-gray-900">
      <tr class="text-white text-left">
        <th class="font-semibold text-sm uppercase px-6 py-4">
          Week {{ week }} Predictions
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      <tr v-for="prediction in predictions" :key="prediction.team_id">
        <td class="px-6 py-4">
          <div class="flex items-center space-x-3">
            <div class="inline-flex w-10 h-10">
              <img
                class="w-10 h-10 object-cover rounded-full"
                alt="User avatar"
                :src="
                  mediaUrl + teamById(prediction.team_id).logo
                "
              />
            </div>
            <div>
              <p>
                {{ teamById(prediction.team_id).name }}
                <b>({{ prediction.winning_percentage }}%)</b>
              </p>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["week"],
  computed: {
    ...mapGetters("teams", ["teams"]),
    ...mapGetters("standings", ["predictions"]),
    mediaUrl() {
      return process.env.MEDIA_URL;
    },
  },
  methods: {
    teamById(id) {
      console.log({ id });
      return this.teams.find((team) => team.id === id);
    },
  },
};
</script>
