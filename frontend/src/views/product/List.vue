<template>
  <page-layout title="產品" id="product-list">
    <product-list
      :rows="rows"
      :pagination="pagination"
      :loading="loading"
      @delete-product="onDeleteProduct"
      @on-page-change="onPageChange">
    </product-list>
    <template slot="actions">
      <Button :to="{ name: 'product.create' }" size="large" type="default" class="icon-padding">建立<Icon type="md-add" /></Button>
    </template>
  </page-layout>
</template>

<script>
import config from '@/config'
import ProductList from '@/components/ProductList';
import { pagination } from '@/api';
import { fetchProductPaginated, deleteProduct } from '@/api/product';

export default {
  components: {
    ProductList
  },
  data() {
    return {
      rows: [],
      loading: false,
      pagination: pagination.generatePagination(1, config.product.list.perPage)
    }
  },
  methods: {
    async fetchProductListData() {
      this.loading = true;

      const res = await fetchProductPaginated(this.pagination.page, this.pagination.perPage);

      this.rows = res.data.data.data
      this.pagination = pagination.extractPaginationMeta(res.data.data);
      this.loading = false;
    },
    onPageChange(page) {
      this.pagination.page = page
      this.fetchProductListData();
    },
    async onDeleteProduct(id) {
      await deleteProduct(id);
      this.fetchProductListData();
    }
  },
  created() {
    this.fetchProductListData();
  }
}
</script>
