<template>
  <div class="title-header">
    <h3>{{title}}</h3>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: [String, null],
      default: null
    }
  }
}
</script>

<style lang="scss">
.title-header {
  margin: 15px 0;
}
</style>

