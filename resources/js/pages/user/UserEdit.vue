<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                <strong>{{error}}</strong>
            </div>

            <h3 class="text-center">Редактор пользователя</h3>
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
                            <input type="text" class="form-control">
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

            <div class="row">
                <h2 class="text-center">Список платежей</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="col">ID</th>
                        <th class="col">Терминал</th>
                        <th class="col">Пользователь</th>
                        <th class="col">Сумма</th>
                        <th class="col">Статус</th>
                        <th class="col">Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment in payments" :key="payment.id">
                        <td class="col">{{ payment.id }}</td>
                        <td class="col">{{ payment.terminal_id }}</td>
                        <td class="col">{{ payment.user?.name }}</td>
                        <td class="col">{{ payment.amount }}</td>
                        <td class="col">{{ payment.status_text }}</td>
                        <td class="col">{{ payment.created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
            payments: {},
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            this.preloaderShow()
            this.$axios
                .patch(`/api/v1/user/${this.$route.params.id}`, this.user)
                .then((res) => {
                    this.user = res.data;
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
    created() {
        this.$axios.get(`/api/v1/user/${this.$route.params.id}`)
            .then(res => {
                this.user = res.data;
            })
            .catch(function (err) {
                console.error(err)
            })


        this.$axios.get(`/api/v1/payment/user/${this.$route.params.id}`)
            .then(res => {
                console.log(res.data);
                this.payments = res.data;
            })
            .catch(function (err) {
                console.error(err)
            })
    },
}
</script>
