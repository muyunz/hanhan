<template>
  <div class="divider-header">
    <h3 v-if="title">{{title}}</h3>
    <flex-spacer></flex-spacer>
    <slot name="actions"></slot>
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
.divider-header {
  display: flex;
  align-items: center;
  border-bottom: 1px solid #e8eaec;
  padding-bottom: 10px;
  margin-bottom: 10px;
}
</style>

