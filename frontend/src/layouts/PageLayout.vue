<template>
  <div class="page-layout">
    <div class="page-layout__header">
      <div class="page-layout__header__left">
        <div class="page-layout__title">{{ title }}</div>
        <div class="page-layout__breadcrumb">
          <breadcrumbs></breadcrumbs>
        </div>
      </div>
      <flex-spacer></flex-spacer>
      <div class="page-layout__header__right">
        <slot name="actions"></slot>
      </div>
    </div>
    <div class="page-layout-content">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String
    }
  }
}
</script>


<style lang="scss">
  .page-layout {
    min-width: 600px;
    width: 80%;
    margin: 60px auto 0 auto;
    .page-layout__header {
      display: flex;
      align-items: center;
      .page-layout__header__left {
        display: flex;
        flex-direction: column;
      }
    }

    .page-layout-content {
      padding-top: 15px;
    }

    .page-layout__title {
      font-size: 40px;
      font-weight: 500;
    }

    .page-layout__breadcrumb {
      margin-left: 5px;
      color: #ccc;
      span {
        font-size: 16px;
      }
    }
  }
</style>
