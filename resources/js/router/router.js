import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login.vue'
import Logout from '../components/login/Logout.vue'
import SignUp from '../components/login/SignUp.vue'
import Forum from '../components/forum/Forum.vue'
import Read from '../components/forum/Read.vue'
import Create from '../components/forum/Create.vue'
import CreateCategory from '../components/category/createCategory.vue'

const routes = [
    { path: '/login', component: Login },
    { path: '/logout', component: Logout },
    { path: '/signup', component: SignUp },
    { path: '/category', component: CreateCategory },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/ask', component: Create },
    { path: '/question/:slug', component: Read, name: 'read' },
]
  
const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router