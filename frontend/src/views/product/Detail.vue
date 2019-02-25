<template>
  <page-layout title="產品" id="product-detail" v-if="product">
    <template slot="actions">
      <Button :to="{ name: 'product.edit', params: { id: product.id } }" size="large" type="default" class="icon-padding-right"><Icon size="20" type="ios-create" />編輯</Button>
    </template>
    <detail-card>
      <div class="product-detail__info">
        <div class="product-detail__preview">
          <image-box
            no-border
            :src="product.preview_url" alt="">
          </image-box>
        </div>
        <div class="product-detail__meta">
          <div class="product-detail__meta__name">
            {{ product.name }}
          </div>
          <div class="product-detail__meta__extra">
            建立日期：{{ moment(product.created_at).locale('zh-tw').format('LL') }}
          </div>
          <div class="product-detail__meta__description">
            {{ product.description }}
          </div>
        </div>
      </div>
      <div class="product-detail__option">
        <divider-header title="選項">
          <template slot="actions">
            <Button @click="editOptionModal.show = true">增加選項</Button>
          </template>
        </divider-header>
        <product-option-edit-tag
          v-for="(option, optionIndex) in productOption.items"
          @delete="deleteOption"
          @edit="editOption"
          :key="optionIndex"
          :option="option">
        </product-option-edit-tag>
      </div>
    </detail-card>
    <edit-product-option-modal
      :product-id="+$route.params.id"
      :option="editOptionModal.option"
      v-model="editOptionModal.show"
      @created="onOptionCreated"
    ></edit-product-option-modal>
  </page-layout>
</template>

<script>
import config from '@/config'
import moment from 'moment';
import { deleteProductOption, fetchProduct, fetchProductOptions } from '@/api/product';
import EditProductOptionModal from '@/components/EditProductOptionModal';
export default {
  components: {
    EditProductOptionModal
  },
  data() {
    return {
      moment,
      product: null,
      productOption: {
        items: [],
        loading: false
      },
      editOptionModal: {
        show: false,
        option: null
      }
    }
  },
  methods: {
    async fetchProduct() {
      try {
        const res = await fetchProduct(this.$route.params.id);
        this.product = res.data.data;
      } catch (e) {
        if (e.response.status === 404) this.$router.push({ name: 'product.list' })
      }
    },
    
    async fetchProductOptions() {
      this.productOption.loading = true;
      const res = await fetchProductOptions(this.$route.params.id);
      this.productOption.items = res.data.data;
      this.productOption.loading = false;
    },

    onOptionCreated(option) {
      this.fetchProductOptions();
      this.editOptionModal.show = false;
    },

    async deleteOption(optionId) {
      await deleteProductOption(this.product.id, optionId);
      this.fetchProductOptions();
    },

    editOption(option) {
      this.editOptionModal.option = option;
      this.editOptionModal.show = true;
    }
  },
  created() {
    this.fetchProduct();
    this.fetchProductOptions();
  }
}
</script>

<style lang="scss">
#product-detail {
  .product-detail__info {
    border: 1px solid #eee;
    border-radius: 4px;
    padding: 35px;
    display: flex;
  }
  .product-detail__meta {
    flex: 1;
    padding: 0 15px;
  }
  .product-detail__preview {
    flex-basis: 30%;
    .image-box {
      width: 100%;
    }
  }
  .product-detail__meta__name {
    font-size: 23px;
    font-weight: bold;
    border-bottom: 1px solid #eee;
    padding: 0 15px 10px 0;
  }
  .product-detail__meta__extra {
    font-size: 14px;
    color: #666;
    padding: 10px 0;
  }
  .product-detail__option {
    padding-top: 35px;
  }
}
</style>
