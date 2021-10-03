<template>
<div class="px-10 py-5 bg-white text-black shadow-lg mb-4 rounded-md flex items-center">
    <img :src="'http://football.test/' + team.logo" :alt="team.name" class="object-contain h-20 mr-2">
    <div>
        <h1 class="mb-2">{{ team.name }}</h1>
        <span class="bg-blue-500 py-1 px-2 rounded-md text-white">{{ team.strength }}</span>
    </div>
</div>
</template>

<script>
    export default {
        props: ['team']
    }
</script>

<style scoped>
img {
    min-width: 150px;
}
</style>
