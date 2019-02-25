<template>
  <div class="pos-index">
    <order-sidebar
      :order="currentOrder"
      @on-order-type-change="onOrderTypeChange"
      @on-product-click="onOrderProductClick">
    </order-sidebar>
    <pos-topbar></pos-topbar>
    <div class="pos-index__main">
      <product-grid
        @on-product-click="onProductClick"
        @on-product-remove="onProductRemove">
      </product-grid>
    </div>
    <product-detail-sidebar
      v-if="orderProductSidebar.show"
      @on-close="onProductDetailSidebarClose"
      @on-option-add="onOptionAdd"
      @on-option-remove="onOptionRemove">
    </product-detail-sidebar>
  </div>
</template>

<script>
import ProductGrid from '@/components/ProductGrid';
import PosTopbar from '@/components/PosTopbar';
import OrderSidebar from '@/components/OrderSidebar';
import ProductDetailSidebar from '@/components/ProductDetailSidebar';
import { mapState, mapActions } from 'vuex';
export default {
  name: 'PosIndex',
  components:{
    ProductGrid,
    OrderSidebar,
    PosTopbar,
    ProductDetailSidebar
  },
  computed: {
    ...mapState('pos', {
      products: state => state.products,
      currentOrder: state => state.currentOrder,
      orderProductSidebar: state => state.orderProductSidebar
    })
  },
  methods: {
    ...mapActions('pos', [
      'addProduct',
      'addOption',
      'removeOption',
      'changeOrderType',
      'showOrderProductSidebar',
      'closeOrderProductSidebar',
      'fetchAllProducts'
    ]),
    onOptionAdd(option) {
      this.addOption({
        subOrderId: option.subOrderId,
        optionId: option.optionId
      });
    },
    onOptionRemove(option) {
      this.removeOption({
        subOrderId: option.subOrderId,
        optionId: option.optionId
      });
    },
    onProductClick(product) {
      console.log(this.products)
      this.addProduct(product);
    },
    onProductRemove(productId) {
      this.removeProduct(productId);
    },
    onOrderTypeChange(type) {
      this.changeOrderType({
        type
      })
    },
    onOrderProductClick(product) {
      this.showOrderProductSidebar(product.product_id);
    },
    onProductDetailSidebarClose() {
      this.closeOrderProductSidebar();
    }
  },
  created() {
    this.fetchAllProducts()
  }
}
</script>

<style lang="scss">
@import "../../styles/_variables.scss";
.pos-index {
  display: flex;
  .pos-index__main {
    padding-left: $pos-order-sidebar-width;
    padding-top: $pos-header-height;
  }
  .pos-topbar {
    position: absolute;
    top: 0;
    left: 0;
    padding-left: $pos-order-sidebar-width;
  }
  .order-sidebar {
    position: fixed;
    top: 0;
    left: 0;
  }
  .product-grid {
    flex: 1;
    padding: 20px;
  }
}
</style>
