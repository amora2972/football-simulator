<template>
  <div class="p-10 shadow-md rounded-md text-black flex justify-evenly items-center mb-2">
    <div class="flex items-center">
        <img :src="'http://football.test/' + match.home_team.logo" alt="" class="object-contain h-20">
      {{ match.home_team.name }} (home)
    </div>
    <div>{{ match.home_goals }} - {{ match.away_goals }}</div>
    <div class="flex items-center">
      <img :src="'http://football.test/' + match.away_team.logo" alt="" class="object-contain h-20">
      {{ match.away_team.name }} (away)
    </div>
  </div>
</template>

<script>
export default {
  props: ["match"],
};
</script>

<style scoped>
img {
    min-width: 150px;
}
</style>
