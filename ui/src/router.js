import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/home.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/login.vue'),
  },
  {
    path: '/logout',
    name: 'logout',
    component: () => import('@/views/logout.vue'),
  },
  {
    path: '/signup',
    name: 'signup',
    component: () => import('@/views/signup.vue'),
  },
  {
    path: '/projects/:id?',
    name: 'projects',
    component: () => import('@/views/projects.vue'),
  },
]

const router = new VueRouter({
  routes
})

export default router
