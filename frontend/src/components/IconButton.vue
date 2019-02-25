<template>
  <div class="icon-button">
    <Icon v-bind="{...$props}" />
  </div>
</template>

<script>
export default {
  props: {
    type: {
      type: String
    },
    size: {
      type: [String, Number],
      default: 24
    },
    color: {
      type: String,
      default: '#000'
    }
  }
}
</script>

<style lang="scss">
  .icon-button {
    cursor: pointer;
    display: inline-block;
  }
</style>
