<template>
    <Modal :value="value" @input="value => $emit('input', value)" width="360">
        <p slot="header" style="text-align:center">
            <span>{{ option ? '編輯' : '建立選項' }}產品選項</span>
        </p>
        <div>
            <Form :model="form" label-position="top" ref="form">
                <FormItem label="名稱">
                    <i-input
                        v-model="form.name"
                        :error="$error($v.form.name, messages.form.name)"
                        @input="$v.form.name.$touch()">
                    </i-input>
                </FormItem>
                <FormItem label="價格">
                    <InputNumber
                        style="width: 120px;"
                        :max="10000"
                        v-model="form.price"
                        :formatter="value => `$ ${value}`.replace(/B(?=(d{3})+(?!d))/g, ',')"
                        :parser="value => value.replace(/$s?|(,*)/g, '')"
                        @input="$v.form.price.$touch()">
                    </InputNumber>
                </FormItem>
            </Form>
        </div>
        <div slot="footer">
            <Button type="text" @click="$emit('input', false)">取消</Button>
            <Button type="primary" @click="store">{{ option ? '更新' : '新增' }}</Button>
        </div>
    </Modal>
</template>

<script>
import config from '@/config';
import { addProductOption, patchProductOption } from '@/api/product';
import { toFormData } from '@/libs/utils'
import { required } from 'vuelidate/lib/validators'

export default {
    props: {
        productId: {
            type: Number
        },
        value: {
            type: Boolean,
            default: false
        },
        option: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            form: {
                name: '',
                price: 0
            },
            messages: {
                form: {
                    name: {
                        required: '請輸入名稱'
                    },
                    preview: {
                        required: '請選擇預覽圖'
                    }
                }
            }
        }
    },
    validations() {
        let rules = {
            form: {
                name: {
                    required
                },
                price: {}
            }
        };
        return rules;
    },
    watch: {
        option(option) {
            if(option) {
                this.form.name = option.name;
                this.form.price = option.price;
            }
        },
        value(val) {
            if(!val) {
                this.form = {
                    name: '',
                    price: 0
                }
            }
        }
    },
    methods: {
        async store() {
            const option = await (this.option ? patchProductOption(this.productId, this.option.id, this.form) : addProductOption(this.productId, this.form));
            this.$emit('created', {
                ...option
            });
            this.form = {
                name: '',
                price: 0
            }
        }
    }
}
</script>

<style lang="scss">

</style>
