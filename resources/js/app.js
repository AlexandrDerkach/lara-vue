require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './components/App.vue'
import Dashboard from './components/Dashboard.vue'
import Home from './components/Home.vue'
import Register from './components/Auth/Register.vue'
import Login from './components/Auth/Login.vue'

import CompaniesIndex from './components/companies/CompaniesIndex.vue'
import CompaniesCreate from './components/companies/CompaniesCreate.vue'
import CompaniesEdit from './components/companies/CompaniesEdit.vue'
import EmailIndex from './components/emailsSending/EmailsSending.vue'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

axios.defaults.baseURL = 'http://localhost:8000/api'

const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },{
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },{
        path: '/companies',
        name: 'companyIndex',
        component: CompaniesIndex,
        meta: {
            auth: true
        }
    },{
        path: '/emailsSanding',
        name: 'emails',
        component: EmailIndex,
        meta: {
            auth: true
        }
    },
    {
        path: '/admin/companies/create',
        component: CompaniesCreate,
        name: 'createCompany'
    },
    {
        path: '/admin/companies/edit/:id',
        component: CompaniesEdit,
        name: 'editCompany'
    }]
});

Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

App.router = Vue.router

new Vue(App).$mount('#app')
