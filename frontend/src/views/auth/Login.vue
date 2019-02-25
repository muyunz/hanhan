<template>
  <div class="login">
    <div class="login-form">
      <div class="login-form__header">
        <p>HanPos</p>
        <p class="login-form__welcome">Welcome</p>
      </div>
      <Form ref="form" :model="form" :rules="formRule" label-position="top">
        <FormItem label="帳號" prop="email">
          <i-input type="text" v-model="form.email"></i-input>
        </FormItem>
        <FormItem label="密碼" prop="password">
          <i-input type="password" v-model="form.password"></i-input>
        </FormItem>
        <FormItem>
          <Button class="login-form__submit" type="primary" @click="handleSubmit">登入</Button>
        </FormItem>
      </Form>
    </div>
  </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex';
  export default {
      data () {
        return {
          form: {
            email: 'admin@com.tw',
            password: 'admin'
          },
          formRule: {
            email: [
              { required: true, message: '請輸入帳號', trigger: 'blur' }
            ],
            password: [
              { required: true, message: '請輸入密碼', trigger: 'blur' }
            ]
          }
        }
      },
      computed: {
        ...mapState('auth', {
          loginRedirect: state => state.loginRedirect
        })
      },
      methods: {
        ...mapActions('auth', ['loginByCredential']),
        async handleSubmit () {
          this.$refs[name].validate(async (valid) => {
            if (valid) {
              await this.loginByCredential(this.form)
              this.$router.replace(this.loginRedirect);
            }
          });
        },
        handleReset (name) {
          this.$refs[name].resetFields();
        }
      }
  }
</script>

<style lang="scss">
  .login {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    .login-form {
      padding: 35px;
      background: #fff;
      min-width: 360px;
      min-height: 300px;
      border-radius: 15px;
      .login-form__submit {
        width: 150px;
      }
      .login-form__header {
        font-size: 16px;
        color: #333;
        padding-bottom: 35px;
        .login-form__welcome {
          font-size: 18px;
          font-weight: bold;
        }
      }
    }
  }
</style>
