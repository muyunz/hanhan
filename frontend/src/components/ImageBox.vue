<template>
    <div class="image-box" :class="{'no-border': noBorder}">
        <img :src="src" alt="">
    </div>
</template>

<script>
export default {
    props: {
        src: {
            type: String
        },
        noBorder: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style lang="scss">
    .image-box {
        display: inline-block;
        text-align: center;
        border: 1px solid #eee;
        background: #fff;
        border-radius: 3px;
        overflow: hidden;
        box-sizing: border-box;
        &.no-border {
            border: 0;
        }
        img {
            width: 100%;
            height: 100%;
        }
    }
</style>
