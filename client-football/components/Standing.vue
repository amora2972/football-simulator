<template>
  <table
    class="
      w-full
      whitespace-nowrap
      rounded-lg
      bg-white
      divide-y divide-gray-300
      overflow-hidden
    "
  >
    <thead class="bg-gray-900">
      <tr class="text-white text-left">
        <th class="font-semibold text-sm uppercase px-6 py-4">Team</th>
        <th class="font-semibold text-sm uppercase px-6 py-4 text-center">
          PTS
        </th>
        <th class="font-semibold text-sm uppercase px-6 py-4 text-center">P</th>
        <th class="font-semibold text-sm uppercase px-6 py-4 text-center">W</th>
        <th class="font-semibold text-sm uppercase px-6 py-4 text-center">L</th>
        <th class="font-semibold text-sm uppercase px-6 py-4 text-center">D</th>
        <th class="font-semibold text-sm uppercase px-6 py-4 text-center">
          GD
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      <tr v-for="standing in standings" :key="standing.id">
        <td class="px-6 py-4">
          <div class="flex items-center space-x-3">
            <div class="inline-flex w-10 h-10">
              <img
                class="w-10 h-10 object-cover rounded-full"
                alt="User avatar"
                :src="mediaUrl + standing.team.logo"
              />
            </div>
            <div>
              <p>{{ standing.team.name }}</p>
            </div>
          </div>
        </td>
        <td class="px-6 py-4 text-center">
          <a href="#" class="text-purple-800 hover:underline">{{
            standing.points
          }}</a>
        </td>
        <td class="px-6 py-4 text-center">
          <a href="#" class="text-purple-800 hover:underline">{{
            standing.times_played
          }}</a>
        </td>
        <td class="px-6 py-4 text-center">
          <span
            class="
              text-white text-sm
              w-1/3
              pb-1
              bg-green-600
              font-semibold
              px-2
              rounded-full
            "
          >
            {{ standing.won }}
          </span>
        </td>
        <td class="px-6 py-4 text-center">{{ standing.lose }}</td>
        <td class="px-6 py-4 text-center">
          <a href="#" class="text-purple-800 hover:underline">{{
            standing.draw
          }}</a>
        </td>
        <td class="px-6 py-4 text-center">
          <a href="#" class="text-purple-800 hover:underline">{{
            standing.goal_drawn
          }}</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters("standings", ["standings"]),
    mediaUrl() {
      return process.env.MEDIA_URL;
    },
  },
  created() {
    this.$store.dispatch("standings/fetchAll");
  },
};
</script>
