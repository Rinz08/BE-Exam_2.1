import { createRouter, createWebHistory } from 'vue-router';
import Login from './components/Login.vue';

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/',
    redirect: '/login', // Redirect to login by default
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import('./components/Dashboard.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
