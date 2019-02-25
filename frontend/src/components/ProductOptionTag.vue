<template>
    <Tag class="product-option-tag" :class="tagClassName" @click.native="$emit('click')">
        <div class="product-option-tag__name">{{ option.name }}</div>
        <div class="product-option-tag__price"><currency :number="option.price"></currency></div>
    </Tag>
</template>

<script>
import { formatCurrency } from '@/libs/utils';
export default {
    props: {
        active: {
            type: Boolean,
            default: false
        },
        option: {
            type: Object
        }
    },
    computed: {
        tagClassName() {
            return {
                'product-option-tag--acitve':  this.active
            }
        }
    }
}
</script>

<style lang="scss">
    .ivu-tag.product-option-tag {
        height: 40px;
        line-height: 40px;
        background: #fff;
        border: 1px solid #666;

        &.product-option-tag--acitve {
            background: #333;
            .product-option-tag__name {
                color: #fff;
            }
            .product-option-tag__price {
                color: #fff;
            }
        }

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
        .product-option-tag__name {
            font-weight: bold;
            padding-right: 10px;
        }
        .product-option-tag__price {
            border-left: 1px solid #666;
            padding-left: 5px;
            font-size: 14px;
        }
    }
</style>
