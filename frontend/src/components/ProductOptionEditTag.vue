<template>
    <Dropdown placement="bottom-start" @on-click="onItemClick">
        <Tag class="product-option-edit-tag">
            <div class="product-option-edit-tag__name">{{ option.name }}</div>
            <div class="product-option-edit-tag__price"><currency :number="option.price"></currency></div>
        </Tag>
        <DropdownMenu slot="list">
            <DropdownItem name="edit">編輯</DropdownItem>
            <DropdownItem name="delete" class="danger-text">刪除</DropdownItem>
        </DropdownMenu>
    </Dropdown>
</template>

<script>
import { formatCurrency } from '@/libs/utils';
export default {
    props: {
        option: {
            type: Object
        }
    },
    methods: {
        onItemClick(name) {
            switch(name) {
                case "edit": return this.$emit('edit', this.option);
                case "delete": return this.$emit('delete', this.option.id);
            }
        }
    }
}
</script>

<style lang="scss">
    .ivu-tag.product-option-edit-tag {
        height: 40px;
        line-height: 40px;
        background: #fff;
        border: 1px solid #666;

        .ivu-tag-text {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            height: 40px;
            line-height: 40px;
            padding: 0;
            margin: 0;
        }
        .product-option-edit-tag__name {
            font-weight: bold;
            padding-right: 10px;
        }
        .product-option-edit-tag__price {
            border-left: 1px solid #666;
            padding-left: 5px;
            font-size: 14px;
        }
    }
</style>
