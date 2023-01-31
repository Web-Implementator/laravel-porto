<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <router-link :to="{name: 'about'}" class="navbar-brand">Описание</router-link>

        <router-link v-if="isAuth === true" :to="{name: 'dashboard'}" class="navbar-brand">Профиль</router-link>
        <router-link v-if="isAuth === true" :to="{name: 'user.getAll'}" class="navbar-brand">Список пользователей</router-link>

        <router-link v-if="isAuth === false" :to="{name: 'signIn'}" class="navbar-brand">Авторизация</router-link>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto"></ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-link">Laravel 9 + Vue 3</li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
export default {

    data() {
        return {
            isAuth: false,
        }
    },
    created() {
        if (window.Laravel.isAuth) {
            this.isAuth = window.Laravel.isAuth
        }
    },
}
</script>
