<template>
  <div class="sidebar">
    <div class="sidebar__logo">
      HanPos
    </div>
    <div class="sidebar__menu">
      <Menu width="auto" theme="dark">
        <MenuItem name="1" :to="{name: 'pos.index'}">
          <Icon type="ios-easel" />
          進入 POS
        </MenuItem>
      </Menu>      
      <div class="sidebar__menu__title">
        MENU
      </div>
      <Menu width="auto" theme="dark">
          <MenuItem name="1" :to="{name: 'product.list'}">
            <Icon type="ios-paper" />
            產品
          </MenuItem>
          <Submenu name="2">
              <template slot="title">
                  <Icon type="ios-people" />
                  用户管理
              </template>
              <MenuItem name="2-1">新增用户</MenuItem>
              <MenuItem name="2-2">活跃用户</MenuItem>
          </Submenu>
          <Submenu name="3">
              <template slot="title">
                  <Icon type="ios-stats" />
                  统计分析
              </template>
              <MenuGroup title="使用">
                  <MenuItem name="3-1">新增和启动</MenuItem>
                  <MenuItem name="3-2">活跃分析</MenuItem>
                  <MenuItem name="3-3">时段分析</MenuItem>
              </MenuGroup>
              <MenuGroup title="留存">
                  <MenuItem name="3-4">用户留存</MenuItem>
                  <MenuItem name="3-5">流失用户</MenuItem>
              </MenuGroup>
          </Submenu>
      </Menu>
    </div>
  </div>  
</template>

<script>
export default {
  
}
</script>

<style lang="scss">
  @import "../styles/_variables.scss";
  .sidebar {
    position: relative;
    width: $sidebar-width;
    height: 100%;
    background: $sidebar-background;
    .sidebar__logo {
      display: flex;
      align-items: center;
      height: $top-bar-height;
      color: #fff;
      font-size: 24px;
      font-weight: 500;
      text-align: left;
      padding: 10px 15px 10px 35px;
      border-bottom: 1px solid #333;
    }
    .sidebar__menu {
      .sidebar__menu__title {
        text-align: left;
        color: #fff;
        font-size: 13px;
        padding: 25px 0px 15px 35px;
      }
      .ivu-menu {
        text-align: left;
        width: 100%;
        &:after {
          width: 0;
        }
        .ivu-icon {
          vertical-align: middle;
          &:first-child {
            width: 30px;
          }
        }
        .ivu-menu-item {
          font-size: 16px;
          padding-left: 35px;
          .ivu-icon {
            font-size: 30px;
          }
          &.ivu-menu-item-active {
            border-right: 0;
          }
        }
        .ivu-menu-submenu-title {
          padding-left: 35px;
        }
        .ivu-menu-submenu {
          font-size: 16px;
          .ivu-menu {
            .ivu-menu-item {
              font-size: 15px;
            }
          }
          .ivu-icon {
            font-size: 30px;
          }
        }
        .ivu-icon.ivu-menu-submenu-title-icon {
          font-size: 16px;
        }
      }
    }
  }
</style>
