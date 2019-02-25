<template>
  <div class="product-grid">
    <div
      @click="onProductClick(product)"
      class="product-col"
      v-for="(product, productIndex) in productArray"
      :key="productIndex">
      <div
        :style="productStyle(product)"
        class="product-item">
        <div class="product-item__preview" :style="productPreviewStyle(product)"></div>
        <div class="product-item__info">
          {{ product.name }}
          <flex-spacer></flex-spacer>
          <currency :number="product.price"></currency>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import config from '@/config'
import { mapState, mapActions } from 'vuex';
import { valuesById } from '@/libs/utils';
export default {
  data() {
    return {
    }
  },
  computed: {
    ...mapState('pos', {
      product: state => state.product
    }),
    productArray() {
      return valuesById(this.product)
    }
  },
  methods: {
    productStyle(product) {
      return {
      }
    },

    productPreviewStyle(product) {
      return {
        backgroundImage: `url(${product.preview_url})`
      }
    },

    onProductClick(product) {
      this.$emit('on-product-click', product)
    }
  },
  created() {
  }
}
</script>


<style lang="scss">
  .product-grid {
    .product-col {
      width: 150px;
      height: 150px;
      margin: 5px;
      float: left;
      .product-item {
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 5px;
        .product-item__preview {
          background: #fff;
          border-top-left-radius: 5px;
          border-top-right-radius: 5px;
          background-size: cover;
          background-position: center center;
          flex: 1;
        }
        .product-item__info {
          display: flex;
          align-items: center;
          padding: 0 15px;
          bottom: 0;
          width: 100%;
          height: 40px;
          background: #fff;

          font-size: 18px;
          color: #333;
          border-bottom-left-radius: 5px;
          border-bottom-right-radius: 5px;
        }
      }
    }
  }
</style>
