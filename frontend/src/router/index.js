import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/',
    name: 'Landing',
    component: () => import('@/pages/LandingPage.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/pages/auth/LoginPage.vue'),
    meta: { layout: 'auth', guest: true }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('@/pages/auth/RegisterPage.vue'),
    meta: { layout: 'auth', guest: true }
  },
  {
    path: '/products',
    name: 'Products',
    component: () => import('@/pages/products/ProductList.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/products/:id',
    name: 'ProductDetail',
    component: () => import('@/pages/products/ProductDetail.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/comparison',
    name: 'Comparison',
    component: () => import('@/pages/products/ComparisonPage.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/calculator',
    name: 'Calculator',
    component: () => import('@/pages/CalculatorPage.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/apply',
    name: 'Apply',
    component: () => import('@/pages/application/ApplicationForm.vue'),
    meta: { layout: 'default', requiresAuth: true }
  },
  {
    path: '/ojk-check',
    name: 'OJKCheck',
    component: () => import('@/pages/OJKCheckPage.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/blog',
    name: 'Blog',
    component: () => import('@/pages/blog/BlogList.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/blog/:id',
    name: 'BlogDetail',
    component: () => import('@/pages/blog/BlogDetail.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/videos',
    name: 'Videos',
    component: () => import('@/pages/VideosPage.vue'),
    meta: { layout: 'default' }
  },
  {
    path: '/dashboard',
    name: 'UserDashboard',
    component: () => import('@/pages/user/Dashboard.vue'),
    meta: { layout: 'user', requiresAuth: true }
  },
  {
    path: '/admin',
    name: 'AdminDashboard',
    component: () => import('@/pages/admin/Dashboard.vue'),
    meta: { layout: 'admin', requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/admin/products',
    name: 'AdminProducts',
    component: () => import('@/pages/admin/Products.vue'),
    meta: { layout: 'admin', requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/admin/applications',
    name: 'AdminApplications',
    component: () => import('@/pages/admin/Applications.vue'),
    meta: { layout: 'admin', requiresAuth: true, requiresAdmin: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  }
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  
  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next({ name: 'Login', query: { redirect: to.fullPath } })
  } else if (to.meta.guest && authStore.isAuthenticated) {
    next({ name: 'UserDashboard' })
  } else if (to.meta.requiresAdmin && !authStore.isAdmin) {
    next({ name: 'UserDashboard' })
  } else {
    next()
  }
})

export default router
