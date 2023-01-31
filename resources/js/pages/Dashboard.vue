<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Профиль</div>

                    <div class="card-body">
                        Добро пожаловать, {{ user.name }}
                        <br>

                        <a class="btn btn-warning" href="/user/getAll">
                            Список пользователей
                        </a>
                        <button type="button" class="btn btn-success m-1" @click="logout">
                            <span id="form-submit">Выход</span>
                            <div id="form-preloader" style="display: none;">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Загрузка...</span>
                                </div>
                            </div>
                        </button>
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
                user: null,
            }
        },
        methods: {
            logout() {
                this.preloaderShow()
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('/api/v1/user/logout', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            if (response.status === 200) {
                                window.location.replace('/')
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error)
                        })
                        .finally(() => {
                            this.preloaderHide()
                        })
                })
            },
            preloaderShow() {
                document.querySelector('#form-preloader').style.display = 'block'
                document.querySelector('#form-submit').style.display = 'none'
            },
            preloaderHide() {
                document.querySelector('#form-preloader').style.display = 'none'
                document.querySelector('#form-submit').style.display = 'block'
            },
        },
        created() {
            if (window.Laravel.user) {
                this.user = window.Laravel.user
            }
        },
        beforeRouteEnter(to, from, next) {
          if (!window.Laravel.isAuth) {
            return next('signIn')
          }
          next();
        }
    }
</script>
