// ----------------------------------------------------------------------------------------
// Router configuration
// ----------------------------------------------------------------------------------------
import { createRouter, createWebHistory } from "vue-router";
import Login from "@/views/Login.vue";
import NotFound from "@/views/NotFound.vue";
import Register from "@/views/Register.vue";
import Dashboard from "@/views/Dashboard.vue";
import OpenCapsule from "@/views/OpenCapsule.vue";
import AccessDenied from "@/views/AccessDenied.vue";
import CreateCapsule from "@/views/CreateCapsule.vue";
import { useAuthStore } from "@/store";

// define routes
const routes = [
  {
    path: "/login",
    component: Login,
    name: "login",
    meta: {
      title: "Login",
    },
  },
  {
    path: "/register",
    component: Register,
    name: "register",
    meta: {
      title: "Register",
    },
  },
  {
    path: "/dashboard",
    children: [
      {
        path: "capsules",
        name: "dashboard",
        component: Dashboard,
        meta: {
          title: "Dashboard",
        },
      },
      {
        path: "create-capsule",
        name: "create-capsule",
        component: CreateCapsule,
        meta: {
          title: "Create Capsule",
        },
      },
      {
        path: "open-capsule/:id",
        name: "open-capsule",
        component: OpenCapsule,
        props: true,
        meta: {
          title: "View Capsule",
        },
      },
    ],
    meta: {
      middleware: "auth",
    },
  },
  {
    path: "/",
    redirect: "/login",
  },
  {
    path: "/forbidden",
    name: "forbidden",
    component: AccessDenied,
    meta: {
      title: "403 Forbidden",
    },
  },
  {
    path: "/:pathMatch(.*)*",
    name: "not-found",
    meta: {
      title: "404 Not Found",
    },
    component: NotFound,
  },
];

// create router instance
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

// middleware
router.beforeEach(async (to, from, next) => {
  document.title = to.meta.title;
  const auth = useAuthStore();
  if (!auth.isAuthenticated) await auth.authenticate(false);

  const middleware = to.meta?.middleware ?? "guest";
  if (middleware == "auth" && !auth.isAuthenticated) {
    next({ name: "login" });
  } else if (
    middleware == "guest" &&
    auth.isAuthenticated &&
    !["not-found", "forbidden"].includes(to.name)
  ) {
    next({ name: "dashboard" });
  } else next();
});

export default router;
