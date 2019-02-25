<template>
  <div id="backend-layout">
    <sidebar></sidebar>
    <div class="backend-layout__content">
      <navbar></navbar>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Sidebar from '@/components/Sidebar';
import Navbar from '@/components/Navbar';

export default {
  components: {
    Sidebar,
    Navbar
  }
}
</script>

<style lang="scss">
@import "../styles/_variables.scss";

#backend-layout {
  display: flex;
  height: 100vh;
  .sidebar {
    z-index: 1;
  }
  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    padding-left: $sidebar-width + 15;
  }
  .backend-layout__content {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding-top: $top-bar-height;
    overflow: auto;
    padding-bottom: 80px;
  }
}
</style>
