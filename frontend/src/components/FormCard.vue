<template>
  <Card class="form-card" dis-hover :padding="0">
    <div class="form-card__content">
      <slot></slot>
    </div>
    <div class="form-card__footer">
      <slot name="footer"></slot>
    </div>
  </Card>
</template>

<script>
export default {
  
}
</script>

<style lang="scss">
  .form-card {
    .form-card__content {
      padding: 60px 80px;
    }
    .form-card__footer {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding: 20px 80px;
      border-top: 1px solid #eee;

      .ivu-btn {
        margin-left: 5px;
      }
    }
  }
</style>
