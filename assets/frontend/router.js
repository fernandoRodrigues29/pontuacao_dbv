import { createRouter, createWebHistory } from 'vue-router';
import DesbravadoresList from './components/DesbravadoresList.vue';
import DesbravadorForm from './components/DesbravadorForm.vue';

const routes = [
  { path: '/', component: DesbravadoresList },
  { path: '/adicionar', component: DesbravadorForm },
  { path: '/editar/:id', component: DesbravadorForm, props: true },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;