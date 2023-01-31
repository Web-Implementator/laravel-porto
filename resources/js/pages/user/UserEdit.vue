<template>
    <div>
        <h3 class="text-center">Редактор пользователя</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="update">
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
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    update() {
        this.$axios
            .get(`/api/v1/user/${this.$route.params.id}`)
            .then((res) => {
                this.user = res.data;
            });
    },
    methods: {
        updateProduct() {
            this.$axios
                .patch(`/api/v1/user/edit/${this.$route.params.id}`, this.product)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                });
        }
    }
}
</script>

<style scoped>

</style>
