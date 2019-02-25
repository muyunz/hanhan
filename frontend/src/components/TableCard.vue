<template>
  <Card class="table-card" :padding="0">
    <div class="table-card__table">
      <slot name="table"></slot>
    </div>
    <div class="table-card__footer">
      <slot name="footer"></slot>
    </div>
  </Card>
</template>

<style lang="scss">
  .table-card {
    .table-card__table {
      // border: 1px solid #ccc;
      border-radius: 5px;
      .ivu-table-wrapper {
        border: 0;
        .ivu-table {
          &:before {
            background: #e3e8ee;
          }
          &:after {
            content: none;
          }
          thead {
            tr {
              th:first-child {
                // padding-left: 18px;
              }
            }
          }
        }
      }
    }
    .table-card__footer {
      display: flex;
      justify-content: flex-end;
      padding: 18px;
    }
  }
</style>
