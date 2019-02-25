<template>
  <div class="order-sidebar">
    <div class="order-sidebar__summary" :style="summaryStyle" v-touch:swipe.left="changeOrderTypeLeft" v-touch:swipe.right="changeOrderTypeRight">
      <div class="order-sidebar__meta">
        <div class="order-sidebar__number">{{ currentOrderType.text }}#0001</div>
      </div>
      <flex-spacer></flex-spacer>
      <!-- <currency :number="total"></currency> -->
    </div>
    <div class="order-sidebar__products">
      <swipe-list :items="Object.keys(order.products)" transition-key="">
        <template slot-scope="{ item }">
          <order-sidebar-product
            @click="onProductClick"
            :product="order.products[item]">
          </order-sidebar-product>
        </template>
        <template slot="right" slot-scope="{ item }">
            <div @click="onProductRemove(item)" class="swipeout-action delete-action">
              刪除
            </div>
        </template>
        <div slot="empty">
        </div>
      </swipe-list>
    </div>
  </div>
</template>

<script>
import { SwipeList, SwipeOut } from 'vue-swipe-actions';
import 'vue-swipe-actions/dist/vue-swipe-actions.css';
import config from '@/config'
import { uuid } from '@/libs/utils'
import OrderType from '@/constants/OrderType';
import OrderSidebarProduct from '@/components/OrderSidebarProduct';
import { mapState, mapActions, mapGetters } from 'vuex';
import _ from 'lodash';

export default {
  components: {
    OrderSidebarProduct,
    SwipeOut,
    SwipeList
  },
  props: {
    order: {
      type: Object
    }
  },
  data() {
    return {
      orderType: {
        [OrderType.FOR_HERE]: {
          // background: "#EE6055",
          background: '#FFF',
          color: "#333",
          text: '內用'
        },
        [OrderType.TO_GO]: {
          // background: "#60D394",
          background: "#FFF",
          color: "#333",
          text: '外帶'
        }
      }
    }
  },
  computed: {
    ...mapState('pos', {
      currentOrder: state => state.currentOrder,
      productOrder: state => state.productOrder,
      product: state => state.product
    }),
    summaryStyle() {
      return {
        ...this.orderType[this.order.type]
      }
    },
    currentOrderType() {
      return this.orderType[this.order.type]
    },
    productTotal(productId) {
      // 完整產品
      const product = this.product.byId[productId];
      // 訂單內容
      const orderProduct = this.currentOrder.products[productId];
      // 子訂單
      const subOrders = orderProduct.orders.map(id => this.productOrder.byId[id]);
      // 組合選項
      const options = orderProduct.options.map(id => product.options[id]);
      
      return product.price * ord
    },
    total() {
      return Object.keys(this.order.products).reduce((sum, productId) => sum + this.order.products[productId].total, 0);
    }
  },
  methods: {
    changeOrderTypeLeft() {
      const orderTypeArray = Object.keys(this.orderType);
      const currentIndex =  orderTypeArray.indexOf(this.order.type);
      const nextIndex = currentIndex - 1 < 0 ? orderTypeArray.length - 1 : currentIndex - 1;
      this.$emit('on-order-type-change', orderTypeArray[nextIndex]);
    },
    changeOrderTypeRight() {
      const orderTypeArray = Object.keys(this.orderType);
      const currentIndex =  orderTypeArray.indexOf(this.order.type);
      const nextIndex = currentIndex + 1 >= orderTypeArray.length ? 0 : currentIndex + 1;
      this.$emit('on-order-type-change', orderTypeArray[nextIndex]);
    },
    onProductRemove(productId) {
      this.$emit('on-product-remove', productId);
    },
    onProductClick(product) {
      this.$emit('on-product-click', product);
    }
  },
  created() {
  }
}
</script>


<style lang="scss">
  @import "../styles/_variables.scss";

  .order-sidebar {
    z-index: 2;
    // box-shadow: 1px 1px 3px 1px rgba(255, 255, 255, 0.3);
    width: $pos-order-sidebar-width;
    height: 100vh;
    background: #fff;
    border-right: 1px solid $pos-border-color;
    .order-sidebar__products {
      .order-sidebar-product {
        padding: 0px 15px;
        margin: 10px 0;
        &:last-child {
          margin-bottom: 0;
        }
      }
      .swipeout-action {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
        box-sizing: border-box;
      }
      .swipeout-action.delete-action {
        background: #fff;
        color: #333;
      }
    }
    .order-sidebar__summary {
      display: flex;
      align-items: center;
      height: $pos-header-height;
      padding: 0 15px;
      border-bottom: 1px solid $pos-border-color;
      .order-sidebar__meta {
        display: flex;
        flex-direction: column;
        font-size: 18px;
        .order-sidebar__number {
          font-size: 25px;
          font-weight: bold;
        }
      }
      .currency {
        font-size: 30px;
        font-weight: bold;
      }
    }
  }
</style>
