<template>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">Users List</h2>

            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-success">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteProduct(user.id)">Delete</button>
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
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios
                .get('/api/v1/user/getAll')
                .then(response => {
                    console.log(response)
                    this.users = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
        });
    },
    methods: {
        deleteProduct(id) {
            this.$axios
                .delete(`/api/v1/user/${id}`)
                .then(response => {
                    let i = this.users.map(data => data.id).indexOf(id);
                    this.users.splice(i, 1)
                });
        }
    }
}
</script>
