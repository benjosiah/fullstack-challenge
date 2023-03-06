import { createRouter, createWebHistory } from "vue-router";
import User from "../views/users/Users.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: User,
    },
  ],
});

export default router;
