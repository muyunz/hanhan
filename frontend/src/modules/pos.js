import config from '@/config'
import OrderType from '@/constants/OrderType';
import Vue from 'vue';
import { fetchAllProducts } from '@/api/product';
import _ from 'lodash';
import { normalize, schema } from 'normalizr';
import { uuid } from '@/libs/utils'

const FETCH_ALL_PRODUCTS = "FETCH_ALL_PRODUCTS";
const READY = "READY";
const ADD_PRODUCT = "ADD_PRODUCT";
const ADD_OPTION = "ADD_OPTION";
const REMOVE_OPTION = "REMOVE_OPTION";
const CHANGE_ORDER_TYPE = "CHANGE_ORDER_TYPE";
const SHOW_ORDER_PRODUCT_SIDEBAR = "SHOW_ORDER_PRODUCT_SIDEBAR";
const CLOSE_ORDER_PRODUCT_SIDEBAR = "CLOSE_ORDER_PRODUCT_SIDEBAR"

// Normalize Schema
const option = new schema.Entity('option');
const product = new schema.Entity('product', {
  options: [option]
});
const productCollection = [product];

// Store
export default {
  namespaced: true,
  state: {
    loaded: false,
    loading: false,
    
    product: {
      byId: {}
    },

    productOption: {
      byId: {}
    },

    subOrder: {
      byId: {}
    },

    orderProduct: {
      byId: {}
    },

    orderProductSidebar: {
      show: false,
      productId: null,
    },

    currentOrder: {
      type: OrderType.FOR_HERE,
      products: {}
    }
  },

  mutations: {
    // 加入訂單
    [ADD_PRODUCT] (state, newProduct) {
      const { subOrder, currentOrder, productOption } = state;
      const order = {
        _id: uuid(),
        options: [],
        total: newProduct.price
      };

      let existsProduct = currentOrder.products[newProduct.id];

      // subOrder.byId[order._id] = order;
      Vue.set(subOrder.byId, order._id, order);

      // 如果已經加入該產品
      if (existsProduct) {
        existsProduct.orders.push(order._id);
      } else {
        existsProduct = {
          product_id: newProduct.id,
          orders: [order._id],
          total: 0
        };

        Vue.set(currentOrder.products, newProduct.id, existsProduct);
      }
      
      // 重新計算總額
      existsProduct.total = 
        existsProduct.orders.reduce((orderSum, orderId) => {
          return orderSum + subOrder.byId[orderId].total
        }, 0);
    },
    [CHANGE_ORDER_TYPE] (state, { orderId = null, type}) {
      const order = orderId ? state.orders[orderId] : state.currentOrder;
      Vue.set(order, 'type', type);
    },

    [SHOW_ORDER_PRODUCT_SIDEBAR] (state, productId) {
      state.orderProductSidebar.productId = productId;
      state.orderProductSidebar.show = true;
    },
    [CLOSE_ORDER_PRODUCT_SIDEBAR] (state) {
      state.orderProductSidebar.productId = null;
      state.orderProductSidebar.show = false;
    },

    [FETCH_ALL_PRODUCTS] (state, products) {
      const normalizedData = normalize(products, productCollection);

      state.product.byId = normalizedData.entities.product;
      state.productOption.byId = normalizedData.entities.option;
    },

    [READY] (state) {
      state.loaded = true;
      state.loading = false;
    },

    [ADD_OPTION] (state, { subOrderId, optionId }) {
      if(!state.subOrder.byId[subOrderId].options.includes(optionId)) {
        state.subOrder.byId[subOrderId].options.push(optionId);
      }
    },
    [REMOVE_OPTION] (state, { subOrderId, optionId }) {
      const index = state.subOrder.byId[subOrderId].options.indexOf(optionId);
      if(index !== -1) {
        state.subOrder.byId[subOrderId].options.splice(index, 1);
      }
    }
  },

  actions: {
    addProduct ({ commit }, product) {
      commit(ADD_PRODUCT, product);
    },
    changeOrderType ({ commit }, { orderId = null, type }) {
      commit(CHANGE_ORDER_TYPE, { orderId, type });
    },
    showOrderProductSidebar ({ commit }, productId) {
      commit(SHOW_ORDER_PRODUCT_SIDEBAR, productId);
    },
    closeOrderProductSidebar({ commit }) {
      commit(CLOSE_ORDER_PRODUCT_SIDEBAR);
    },
    addOption({ commit }, { subOrderId, optionId }) {
      commit(ADD_OPTION, { subOrderId, optionId })
    },
    removeOption({ commit }, { subOrderId, optionId }) {
      commit(REMOVE_OPTION, { subOrderId, optionId })
    },
    async fetchAllProducts ({ commit }) {
      const res = await fetchAllProducts();
      commit(FETCH_ALL_PRODUCTS, res.data.data);
    }
  }
}