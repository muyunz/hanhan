<template>
  <page-layout :title="product ? '編輯產品' : '新增產品'" id="product-create">
    <form-card>
      <divider-header title="資訊"></divider-header>
      <Form :model="form" label-position="top" ref="form">
        <FormItem label="預覽圖" :error="$error($v.form.preview, messages.form.preview)">
          <image-uploader
            @change="onPreviewSelected"
            :default-preview-src="product ? product.preview_url : null"
          ></image-uploader>
        </FormItem>
        <FormItem label="名稱">
          <i-input v-model="form.name" :error="$error($v.form.name, messages.form.name)" @input="$v.form.name.$touch()"></i-input>
        </FormItem>
        <FormItem label="描述">
          <i-input type="textarea" :rows="4" v-model="form.description" :error="$error($v.form.description, messages.form.description)" @input="$v.form.description.$touch()"></i-input>
        </FormItem>
        <FormItem label="價格">
          <InputNumber
            style="width: 120px;"
            :max="10000"
            v-model="form.price"
            :formatter="value => `$ ${value}`.replace(/B(?=(d{3})+(?!d))/g, ',')"
            :parser="value => value.replace(/$s?|(,*)/g, '')"
            @input="$v.form.price.$touch()"></InputNumber>
        </FormItem>
      </Form>
      <template slot="footer">
        <Button size="large" type="text" @click="cancel">取消</Button>
        <Button size="large" type="primary" @click="submit">{{ product ? '更新' : '新增' }}</Button>
      </template>
    </form-card>
  </page-layout>
</template>

<script>
import config from '@/config';
import { createProduct, patchProduct, fetchProduct } from '@/api/product';
import { toFormData } from '@/libs/utils'
import { required } from 'vuelidate/lib/validators'

export default {
  data() {
    return {
      product: null,
      form: {
        name: '',
        description: '',
        price: 0,
        preview: null
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
        description: {},
        preview: {},
        price: {}
      }
    };

    if (!this.product) {
      rules.form.preview = {
        required
      };
    }

    return rules;
  },
  methods: {
    onPreviewSelected(file) {
      this.form.preview = file;
      this.$v.form.preview.$touch();
    },

    async submit() {
      const form = this.product ? this.$extractDirtyFields(this.$v.form) : this.form;
      this.$validate(this.$v.form, async () => {
        this.store(form);
      });
    },

    async store(form) {
      const formData = toFormData(form);
      const action = this.product ? (_formData) => patchProduct(this.product.id, _formData) : createProduct
      const res = await action(formData);
      this.$router.push({
        name: 'product.detail',
        params: {
          id: res.data.data.id
        }
      });
    },

    cancel() {
      if (this.$route.params.id) {
        this.$router.push({
          name: 'product.detail'
        });
      } else {
        this.$router.push({
          name: 'product.list'
        });
      }
    }
  },

  async created() {
    if (this.$route.params.id) {
      const res = await fetchProduct(this.$route.params.id);
      this.product = res.data.data;
      this.form.name = this.product.name;
      this.form.description = this.product.description;
      this.form.price = this.product.price;
      this.$v.form.$reset();
    }
  }
}
</script>

<style lang="scss">
#product-create {

}
</style>

