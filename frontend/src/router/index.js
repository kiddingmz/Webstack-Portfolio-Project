import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../pages/home/HomePage.vue'
import Guard from '@/services/middleware';

const routes = [
  {
    path: '/',
    name: 'home',
    alias: '/home',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: HomeView
  },
  {
    path: '/correspondencia',
    name: 'correspondencia',
    alias: '/entrada-de-correspondencia',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "correspondencia" */ '../pages/correspondence/CorrespondencePage.vue')
  },
  {
    path: '/protocolo',
    name: 'protocolo',
    alias: '/protocolo-interno-e-externo',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/protocol/ProtocolPage.vue')
  },
  {
    path: '/protocolo/registo',
    name: 'protocolo-registo',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/protocol/CreateProtocolPage.vue')
  },
  {
    path: '/protocolo/actualizar/:id',
    name: 'protocolo-actualizar',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/protocol/UpdateProtocolPage.vue')
  },
  {
    path: '/correspondencia/actualizar/:id',
    name: 'correspondencia-actualizar',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/correspondence/UpdateCorrespondencePage.vue')
  },
  {
    path: '/correspondencia/registo',
    name: 'correspondencia-registo',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/correspondence/CreateCorrespondencePage.vue')
  },
  {
    path: '/auth/sign_in',
    name: 'login',
    beforeEnter: Guard.redirectIfAuthenticated,
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/sign_in/SignInPage.vue')
  },
  {
    path: '/auth',
    redirect: { name: 'login' },
  },
  {
    path: '/sign_up',
    name: 'registo',
    meta: { title: 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD', favicon: 'favicon.png' },
    component: () => import(/* webpackChunkName: "protocolo" */ '../pages/register/SignUpPage.vue')
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'Instituto Nacional de Gestão e Redução do Risco de Desastres - INGD'
  const favicon = to.meta.favicon || 'favicon.png'
  const link = document.querySelector("link[rel*='icon']") || document.createElement('link')
  link.type = 'image/x-icon'
  link.rel = 'shortcut icon'
  link.href = favicon
  document.getElementsByTagName('head')[0].appendChild(link)
  next()
})
export default router
