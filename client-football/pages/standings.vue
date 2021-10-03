<template>
<div>
  <Standing/>
  <nuxt-link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" to='/'>Go Back Home</nuxt-link>
</div>
</template>

<script>
import Standing from '../components/Standing'

export default {
  components: {Standing}
};
</script>
