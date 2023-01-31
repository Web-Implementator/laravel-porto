<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                <strong>{{error}}</strong>
            </div>

            <h3 class="text-center">Создание пользователя</h3>
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" v-model="user.email">
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="text" class="form-control" v-model="user.password">
                        </div>
                        <button type="submit" class="btn btn-success mt-1" @click="handleSubmit">
                            <span id="form-submit">Сохранить</span>
                            <div id="form-preloader" style="display: none;">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Загрузка...</span>
                                </div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            this.preloaderShow()
            this.$axios
                .post(`/api/v1/user/create`, this.user)
                .then((res) => {
                    this.user = res.data
                    this.$router.push({ name: 'user.getAll' })
                })
                .catch(err => {
                    console.error(err)
                    this.error = err.response.data.message.text
                })
                .finally(() => {
                    this.preloaderHide()
                })
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
    created() {},
}
</script>
