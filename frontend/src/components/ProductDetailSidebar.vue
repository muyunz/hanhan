<template>
  <div class="product-detail-sidebar">
    <div class="product-detail-sidebar__header" v-touch:swipe.left="nextSubOrder" v-touch:swipe.right="previousSubOrder">
      {{ currentProduct.name }} - {{ currentSubOrderIndex + 1 }} 號
      <flex-spacer></flex-spacer>
      <Icon type="ios-close" @click="close"></Icon>
    </div>
    <div class="product-detail-sidebar__options">
      <product-option-tag
        v-for="option in options"
        :key="option.id"
        :option="option"
        :active="optionSelected(option.id)"
        @click="toggleOption(option)"
      ></product-option-tag>
    </div>
    <div class="product-detail-sidebar__bottom">
      更多訂單
    </div>
  </div>
</template>

<script>
import { SwipeList, SwipeOut } from 'vue-swipe-actions';
import 'vue-swipe-actions/dist/vue-swipe-actions.css';
import config from '@/config'
import OrderType from '@/constants/OrderType';
import OrderSidebarProduct from '@/components/OrderSidebarProduct';
import { mapState, mapActions, mapGetters } from 'vuex';
import _ from 'lodash';
import { valuesById } from '@/libs/utils';

export default {
  components: {
    OrderSidebarProduct,
    SwipeOut,
    SwipeList
  },
  data() {
    return {
      currentSubOrderIndex: 0,
      orderType: {
        [OrderType.FOR_HERE]: {
          background: "#EE6055",
          color: "#fff",
          text: '內用'
        },
        [OrderType.TO_GO]: {
          background: "#60D394",
          color: "#fff",
          text: '外帶'
        }
      }
    }
  },
  computed: {
    ...mapState('pos', {
      // 全部產品
      productByIds: state => state.product.byId,
      // 訂單欄資訊
      sidebar: state => state.orderProductSidebar,
      // 目前產品
      currentProduct: state => state.product.byId[state.orderProductSidebar.productId],
      // 目前訂單
      currentOrder: state => state.currentOrder,
      // 目前訂單產品
      currentOrderProduct: state => state.currentOrder.products[state.orderProductSidebar.productId],
      // 所有子訂單
      subOrderByIds: state => state.subOrder.byId,
      // 該產品選項
      options: state => state.product.byId[state.orderProductSidebar.productId].options.map(id => state.productOption.byId[id])
    }),
    currentSubOrder() {
      return this.subOrderByIds[this.currentOrderProduct.orders[this.currentSubOrderIndex]];
    },
    summaryStyle() {
      return {
        ...this.orderType[this.order.type]
      }
    },
    currentOrderType() {
      return this.orderType[this.order.type]
    }
  },
  methods: {
    ...mapActions('pos', {
    }),
    close() {
      this.$emit('on-close');
    },
    optionSelected(optionId) {
      return this.currentSubOrder.options.includes(optionId);
    },
    previousSubOrder() {
      this.currentSubOrderIndex = this.currentSubOrderIndex - 1 < 0 ? this.currentOrderProduct.orders.length - 1 : this.currentSubOrderIndex - 1;
    },
    nextSubOrder() {
      this.currentSubOrderIndex = this.currentSubOrderIndex + 1 >= this.currentOrderProduct.orders.length ? 0 : this.currentSubOrderIndex + 1;
    },
    onProductRemove(productId) {
      this.$emit('on-product-remove', productId);
    },
    toggleOption(option) {
      this.optionSelected(option.id) ? this.removeOption(option) : this.addOption(option)
    },
    addOption(option) {
      this.$emit('on-option-add', {
        optionId: option.id,
        productId: this.currentProduct.id,
        subOrderId: this.currentSubOrder._id,
      })
    },
    removeOption(option) {
      this.$emit('on-option-remove', {
        optionId: option.id,
        productId: this.currentProduct.id,
        subOrderId: this.currentSubOrder._id,
      })
    }
  },
  created() {
  }
}
</script>


<style lang="scss">
  @import "../styles/_variables.scss";
  .product-detail-sidebar {
    z-index: 1;
    position: absolute;
    left: $pos-order-sidebar-width;
    width: $pos-order-sidebar-width;
    height: 100vh;
    background: #fff;
    border-right: 1px solid #eee;
    .product-detail-sidebar__header {
      height: 65px;
      width: 100%;
      background: #333;
      color: #fff;
      font-size: 30px;
      display: flex;
      align-items: center;
      padding: 0 25px;
    }
    .product-detail-sidebar__options {
      padding: 10px 15px;
    }
    .product-detail-sidebar__bottom {
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      position: absolute;
      bottom: 0;
      box-shadow: 0px 0px 1px 1px #eee;
      padding: 15px 25px;
    }
  }
</style>
