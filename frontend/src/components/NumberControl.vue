<template>
    <div class="number-control">
        <div class="number-control__minus" @click="minus">
            <Icon type="minus" />
        </div>
        <div class="number-control__number">{{ number }}</div>
        <div class="number-control__plus" @click="plus">
            <Icon type="plus" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Number
        }
    },
    methods: {
        minus() {
            this.$emit('input', this.value - 1);
            this.$emit('decrease');
        },
        plus() {
            this.$emit('input', this.value + 1);
            this.$emit('increase')
        }
    }
}
</script>

<style lang="scss">
    .number-control {
        width: 120px;
        height: 40px;
        display: flex;
        align-items: center;
        border: 1px solid #2b85e4;

        .number-control__minus {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            height: 100%;
            border-right: 1px solid #2b85e4;
            background: rgba(43,133,228,0.1);
            flex: 1;
            color: #2b85e4;
        }
        .number-control__number {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            height: 100%;
            flex: 1;
        }
        .number-control__plus {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            height: 100%;
            border-left: 1px solid #2b85e4;
            background: rgba(43,133,228,0.1);
            color: #2b85e4;
            flex: 1;
        }
    }
</style>
