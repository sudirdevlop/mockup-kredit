<template>
  <div class="min-h-screen bg-gray-50">
    <AppHeader />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <aside class="md:col-span-1">
          <nav class="bg-white rounded-lg shadow-md p-4">
            <router-link
              to="/dashboard"
              class="block px-4 py-2 rounded-lg mb-2 hover:bg-gray-100 transition-colors"
              :class="{ 'bg-primary-50 text-primary-600': $route.path === '/dashboard' }"
            >
              Dashboard
            </router-link>
            <router-link
              to="/dashboard/applications"
              class="block px-4 py-2 rounded-lg mb-2 hover:bg-gray-100 transition-colors"
              :class="{ 'bg-primary-50 text-primary-600': $route.path.includes('/applications') }"
            >
              Pengajuan Saya
            </router-link>
            <router-link
              to="/dashboard/profile"
              class="block px-4 py-2 rounded-lg mb-2 hover:bg-gray-100 transition-colors"
              :class="{ 'bg-primary-50 text-primary-600': $route.path.includes('/profile') }"
            >
              Profil
            </router-link>
            <router-link
              to="/dashboard/settings"
              class="block px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors"
              :class="{ 'bg-primary-50 text-primary-600': $route.path.includes('/settings') }"
            >
              Pengaturan
            </router-link>
          </nav>
        </aside>
        <main class="md:col-span-3">
          <slot />
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import AppHeader from './AppHeader.vue'
</script>
