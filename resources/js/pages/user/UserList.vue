<template>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">Users List</h2>

            <div class="col-12 text-end">
                <router-link :to="{name: 'user.create'}" class="btn btn-info">Создание пользователя</router-link>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th class="col-2">ID</th>
                    <th class="col-4">Name</th>
                    <th class="col-4">Email</th>
                    <th class="col-2 text-end">Действия</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td class="col-2">{{ user.id }}</td>
                    <td class="col-4">{{ user.name }}</td>
                    <td class="col-4">{{ user.email }}</td>
                    <td class="col-2 text-end">
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'user.edit', params: { id: user.id }}" class="btn btn-success">Редактировать</router-link>
                            <button class="btn btn-danger" @click="deleteProduct(user.id)">Удалить</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: []
        }
    },
    created() {
        this.$axios
            .get('/api/v1/user/getAll')
            .then(response => {
                this.users = response.data
            })
            .catch(err => {
                console.log(err)
            })
    },
    methods: {
        deleteProduct(id) {
            this.$axios
                .delete(`/api/v1/user/${id}`)
                .then(response => {
                    let i = this.users.map(data => data.id).indexOf(id)
                    this.users.splice(i, 1)
                })
        },
    }
}
</script>
