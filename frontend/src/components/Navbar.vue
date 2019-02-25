<template>
  <div class="navbar">
    <flex-spacer></flex-spacer>
    <div class="navbar__user">
      USERNAME
      <Avatar icon="ios-person"/>
    </div>
  </div>
</template>

<script>
export default {
  
}
</script>

<style lang="scss">
  @import "../styles/_variables.scss";

  .navbar {
    position: relative;
    width: 100%;
    background: #fff;
    height: $top-bar-height - 1;
    box-shadow: 0px 0px 0px 1px #eee;
    padding: 0 15px;

    display: flex;
    align-items: center;

    .navbar__user {
      display: flex;
      align-items: center;
      font-size: 14px;
      font-weight: 500;
      .ivu-avatar {
        margin-left: 10px;
      }
    }
  }
</style>
