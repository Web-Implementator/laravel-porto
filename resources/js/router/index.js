import {createWebHistory, createRouter} from "vue-router";

import About from "../pages/About.vue";
import SignIn from "../pages/auth/SignIn.vue";
import SignUp from "../pages/auth/SignUp.vue";
import Dashboard from "../pages/Dashboard.vue";
import UserList from "../pages/user/UserList.vue";
import UserCreate from "../pages/user/UserCreate.vue";
import UserEdit from "../pages/user/UserEdit.vue";

export const routes = [
    {
        name: 'about',
        path: '/',
        component: About
    },
    {
        name: 'signIn',
        path: '/signIn',
        component: SignIn
    },
    {
        name: 'signUp',
        path: '/signUp',
        component: SignUp
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'user.getAll',
        path: '/user/getAll',
        component: UserList
    },
    {
        name: 'user.create',
        path: '/user/create',
        component: UserCreate
    },
    {
        name: 'user.edit',
        path: '/user/edit/:id',
        component: UserEdit
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
