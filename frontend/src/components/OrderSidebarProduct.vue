<template>
  <div ontouchstart class="order-sidebar-product" @click="$emit('click', product)">
    <div class="order-sidebar-product__preview" :style="previewStyle"></div>
    <div class="order-sidebar-prodcut__title">
      <div class="order-sidebar-product__name">{{ _product.name }}</div>
    </div>
    <div class="order-sidebar-product__horizon order-sidebar-product__right">
      <div class="order-sidebar-product__amount">
        <number-control :value="product.orders.length" @increase="onOrderIncrease" @decrease="onOrderDecrease"></number-control>
      </div>
      <div class="order-sidebar-product__price">
        <currency :number="total"></currency>
      </div>
    </div>
    <div class="order-sidebar-product__options">
      <div class="order-sidebar-product__option" v-for="(option, optionIndex) in _product.options" :key="optionIndex">{{ option.name }}</div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  props: {
    product: {
      type: Object
    }
  },
  computed: {
    ...mapState('pos', {
      _product(state) {
        return state.product.byId[this.product.product_id]
      },
      productOptionByIds: state => state.productOption.byId,
      subOrderByIds: state => state.subOrder.byId,
      productOptionIds: state => state.productOption.byId,
    }),
    previewStyle() {
      return {
        backgroundImage: `url(${this._product.preview_url})`
      };
    },
    total() {
      return (this.product.orders.length * this._product.price) + 
        this.product.orders.reduce((orderSum, orderId) => {
          const order = this.subOrderByIds[orderId];
          const optionTotal = order.options.reduce((optionSum, optionId) => {
            return optionSum + this.productOptionIds[optionId].price
          }, 0)
          return orderSum + optionTotal
        }, 0);
    }
  },
  methods: {
    onOrderIncrease() {},
    onOrderDecrease() {}
  }
}
</script>

<style lang="scss">
.order-sidebar-product {
  display: flex;
  align-items: center;
  min-height: 50px;
  &:focus:active {
    background: #f2f2f2;
  }
  .order-sidebar-product__horizon {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .order-sidebar-product__right {
    width: 60px;
    align-items: flex-end;
  }
  .order-sidebar-product__name {
    display: flex;
    align-items: center;
    flex: 1;
    padding-left: 10px;
    font-size: 20px;
    font-weight: bold;
  }
  .order-sidebar-product__price {
    text-align: right;
    font-size: 18px;
    line-height: 16px;
    font-weight: bold;
    color: #999;
  }
  .order-sidebar-product__amount {
    font-size: 30px;
    line-height: 25px;
    color: #333;
    font-weight: bold;
  }
  .order-sidebar-product__info {
    flex: 1;
    padding-left: 15px;
    display: flex;
    flex-direction: column;
  }
  .order-sidebar-prodcut__title {
    flex: 1;
    display: flex;
    flex-direction: row;
  }
  .order-sidebar-product__preview {
    background-position: center center;
    background-size: cover;
    height: 80px;
    width: 80px;
  }

  .order-sidebar-product__options {
    .order-sidebar-product__option {
      color: #666;
    }
  }
}
</style>
