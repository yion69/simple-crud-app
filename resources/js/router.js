// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
{
    path: '/',
    name: 'Panel',
    component: Panel
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router