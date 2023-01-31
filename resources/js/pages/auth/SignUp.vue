<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

          <strong>{{error}}</strong>
        </div>

        <div class="card card-default">
          <div class="card-header">Регистрация</div>
          <div class="card-body">
            <form>

              <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label text-md-right">Имя</label>
                <div class="col-md-8">
                  <input id="name" type="text" class="form-control" v-model="name" required
                         autofocus autocomplete="off"  placeholder="">
                </div>
              </div>

              <div class="form-group row mt-1">
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
                        <span id="form-submit">Зарегистрироваться</span>
                        <div id="form-preloader" style="display: none;">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Загрузка...</span>
                            </div>
                        </div>
                    </button>
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
            name: "",
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
                this.$axios.post('/api/v1/user/register', {
                  name: this.name,
                  email: this.email,
                  password: this.password
                })
                    .then(response => {
                        const { data } = response
                      if (data.id) {
                        window.location.href = "/signIn"
                      } else {
                        this.error = data.message.text
                      }
                    })
                    .catch(e => {
                        console.error(e)
                        this.error = e.response.data.message.text
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
            return next('/');
          }
          next();
        }
    }
</script>
