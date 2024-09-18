import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../pages/home/HomePage.vue'
import Guard from '@/services/middleware';

const routes = [
  {
    path: '/',
    name: 'home',
    alias: '/home',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Medical prescription',},
    component: HomeView
  },
  {
    path: '/prescription',
    name: 'prescription',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Medical prescription',},
    component: () => import(/* webpackChunkName: "correspondencia" */ '@/pages/prescription/PrescriptionPage.vue')
  },
  {
    path: '/prescription/update/:id',
    name: 'prescriptionUpdate',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Medical prescription',},
    component: () => import(/* webpackChunkName: "protocolo" */ '@/pages/prescription/UpdatePrescriptionPage.vue')
  },
  {
    path: '/prescription/new',
    name: 'prescriptionCreate',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Medical prescription',},
    component: () => import(/* webpackChunkName: "protocolo" */ '@/pages/prescription/CreatePrescriptionPage.vue')
  },
  {
    path: '/auth/sign_in',
    name: 'login',
    beforeEnter: Guard.redirectIfAuthenticated,
    meta: { title: 'Medical prescription',},
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/sign_in/SignInPage.vue')
  },
  {
    path: '/auth',
    redirect: { name: 'login' },
  },
  {
    path: '/sign_up',
    name: 'registo',
    meta: { title: 'Medical prescription', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/register/SignUpPage.vue')
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'Medical prescription'
  next()
})
export default router
