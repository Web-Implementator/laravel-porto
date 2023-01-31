<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

          <strong>{{error}}</strong>
        </div>

        <div class="card card-default">
          <div class="card-header">Авторизация</div>
          <div class="card-body">
            <form>
              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                <div class="col-md-8">
                  <input id="email" type="email" class="form-control" v-model="email" required
                         autofocus autocomplete="off" placeholder="">
                </div>
              </div>


              <div class="form-group row mt-1">
                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>
                <div class="col-md-8">
                  <input id="password" type="password" class="form-control" v-model="password"
                         required autocomplete="off" placeholder="">
                </div>
              </div>

              <div class="form-group row mt-1 mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-success" @click="handleSubmit">
                      <span id="form-submit">Войти</span>
                      <div id="form-preloader" style="display: none;">
                          <div class="spinner-border spinner-border-sm" role="status">
                              <span class="visually-hidden">Загрузка...</span>
                          </div>
                      </div>
                  </button>
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-md-8 offset-md-4">
                  <small class="text-muted">
                    Нет аккаунта?
                    <router-link to="/signUp">Зарегистрироваться</router-link>
                  </small>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
    export default {
        mounted() {
          // console.log('Component mounted.')
        },
        data() {
          return {
            email: "",
            password: "",
            error: null
          }
        },
        methods: {
          handleSubmit(e) {
            e.preventDefault()
            this.preloaderShow()
            if(this.password.length > 0) {
              this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/v1/user/login', {
                  email: this.email,
                  password: this.password
                })
                    .then(response => {
                      if (response.data.access_token) {
                          window.location.replace('/')
                      } else {
                        this.error = response.data.message.text
                      }
                    })
                    .catch(err => {
                        console.error(err)
                        this.error = err.response.data.message.text
                    })
                    .finally(() => {
                        this.preloaderHide()
                    })
              })
            }
          },
          preloaderShow() {
              this.error = null
              document.querySelector('#form-preloader').style.display = 'block'
              document.querySelector('#form-submit').style.display = 'none'
          },
          preloaderHide() {
            document.querySelector('#form-preloader').style.display = 'none'
            document.querySelector('#form-submit').style.display = 'block'
          },
        },
        beforeRouteEnter(to, from, next) {
          if (window.Laravel.isAuth) {
            return next('/')
          }
          next()
        }
    }
</script>
