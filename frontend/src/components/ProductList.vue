<template>
  <div class="product-list">
    <table-card>
      <Table
        slot="table"
        no-data-text="尚無產品"
        no-filtered-data-text="找不到符合條件之產品"
        disabled-hover
        :loading="loading"
        :columns="columns"
        :data="rows">
      </Table>
      <div slot="footer">
        <flex-spacer></flex-spacer>
        <Page
          :total="pagination.total"
          size="small"
          @on-change="onPageChange"/>
      </div>
    </table-card>
  </div>
</template>

<script>
export default {
  props: {
    rows: {
      type: Array
    },
    pagination: {
      type: Object
    },
    loading: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      actionMenu: [
        { text: '編輯', name: 'edit' },
        { text: '刪除', name: 'remove', className: 'danger-text' }
      ],
      actionHandler: {
        edit: this.edit,
        remove: this.remove
      },
      columns: [
        {
          type: 'selection',
          width: 60,
          align: 'center'
        },
        {
          title: '產品',
          key: 'name',
          render: (h, params) => {
            return (
              <div class="product-list__table__name">
                <image-box class="product-list__table__image" src={params.row.preview_url} shape="square" icon="ios-person" size="large" />
                <router-link to={{name: 'product.detail', params: { id: params.row.id }}}>{params.row.name}</router-link>
              </div>
            )
          }
        },
        {
          title: '價格',
          key: 'price',
          class: 'product-list__table__price',
          render: (h, params) => {
            return (
              <currency number={params.row.price}></currency>
            )
          }
        },
        {
          title: '操作',
          key: 'action',
          width: 80,
          align: 'center',
          render: (h, params) => {
            const { actionHandler } = this;
            return (
              <table-action-button
                id={params.row.id}
                menu={this.actionMenu}
                on-menu-item-click={name => actionHandler[name](params.row.id)}
              ></table-action-button>
            )
          }
        }
      ],
    }
  },
  methods: {
    onPageChange(page) {
      this.$emit('on-page-change', page);
    },
    edit(id) {
      this.$router.push({
        name: 'product.edit',
        params: {
          id
        }
      })
    },
    remove(id) {
      this.$emit('delete-product', id)
    }
  }
}
</script>

<style lang="scss">
.product-list__table__image {
  width: 50px;
  height: 50px;
}
.product-list__table__name {
  display: flex;
  align-items: center;
  color: #333;
  font-weight: bold;
  padding: 10px 0;
  a {
    color: #333;
  }
  .image-box {
    margin-right: 10px;
  }
}
</style>
