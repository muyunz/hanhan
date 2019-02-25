<template>
  <div class="breadcrumbs">
    <Breadcrumb separator=">">
      <BreadcrumbItem v-for="(breacrumb, index) in breacrumbs" :key="index" :to="breacrumb.link">
        {{ breacrumb.text }}
      </BreadcrumbItem>
    </Breadcrumb>
  </div>
</template>

<script>
export default {
  computed: {
    breacrumbs() {
      return this.$route.meta.breadcrumbs
    }
  }
}
</script>

<style lang="scss">
  .breadcrumbs {
    .ivu-breadcrumb-item-separator {
      padding: 0;
      margin: 0;
    }
  }
</style>
