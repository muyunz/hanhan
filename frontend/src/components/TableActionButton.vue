<template>
    <Dropdown @on-click="onMenuItemClick">
        <icon-button color="#666r" type="ios-more" size="24"/>
        <DropdownMenu slot="list">
            <DropdownItem
              v-for="(item, index) in menu"
              :key="index"
              :name="item.name"
            >
              <span :class="item.className">{{ item.text }}</span>
            </DropdownItem>
        </DropdownMenu>
    </Dropdown>
</template>

<script>
export default {
  props: {
    menu: {
      type: Array
    }
  },
  methods: {
    onMenuItemClick(name) {
      this.$emit('menu-item-click', name);
    }
  }
}
</script>