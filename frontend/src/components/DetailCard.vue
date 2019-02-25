<template>
  <Card class="detail-card" dis-hover :padding="0">
    <div class="detail-card__content">
      <slot></slot>
    </div>
  </Card>
</template>

<script>
export default {
  
}
</script>

<style lang="scss">
  .detail-card {
    .detail-card__content {
      padding: 60px 80px;
    }
  }
</style>
