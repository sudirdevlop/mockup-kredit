<template>
  <header class="bg-white shadow-sm sticky top-0 z-40">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center">
          <router-link to="/" class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-primary-600">KreditHub</span>
          </router-link>
          
          <div class="hidden md:flex ml-10 space-x-8">
            <router-link to="/products" class="text-gray-700 hover:text-primary-600 transition-colors">
              Produk
            </router-link>
            <router-link to="/calculator" class="text-gray-700 hover:text-primary-600 transition-colors">
              Kalkulator
            </router-link>
            <router-link to="/comparison" class="text-gray-700 hover:text-primary-600 transition-colors">
              Bandingkan
            </router-link>
            <router-link to="/blog" class="text-gray-700 hover:text-primary-600 transition-colors">
              Artikel
            </router-link>
            <router-link to="/ojk-check" class="text-gray-700 hover:text-primary-600 transition-colors">
              Cek OJK
            </router-link>
          </div>
        </div>
        
        <div class="flex items-center space-x-4">
          <router-link
            v-if="!authStore.isAuthenticated"
            to="/login"
            class="text-gray-700 hover:text-primary-600 transition-colors"
          >
            Masuk
          </router-link>
          <router-link
            v-if="!authStore.isAuthenticated"
            to="/register"
          >
            <BaseButton variant="primary" size="sm">Daftar</BaseButton>
          </router-link>
          
          <div v-else class="relative">
            <button
              @click="showUserMenu = !showUserMenu"
              class="flex items-center space-x-2 text-gray-700 hover:text-primary-600"
            >
              <span>{{ authStore.user?.name }}</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            
            <div
              v-if="showUserMenu"
              class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 border border-gray-200"
            >
              <router-link
                to="/dashboard"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                @click="showUserMenu = false"
              >
                Dashboard
              </router-link>
              <router-link
                v-if="authStore.isAdmin"
                to="/admin"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                @click="showUserMenu = false"
              >
                Admin Panel
              </router-link>
              <button
                @click="handleLogout"
                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
              >
                Keluar
              </button>
            </div>
          </div>
          
          <button @click="showMobileMenu = !showMobileMenu" class="md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
      
      <div v-if="showMobileMenu" class="md:hidden py-4 border-t border-gray-200">
        <router-link
          to="/products"
          class="block py-2 text-gray-700 hover:text-primary-600"
          @click="showMobileMenu = false"
        >
          Produk
        </router-link>
        <router-link
          to="/calculator"
          class="block py-2 text-gray-700 hover:text-primary-600"
          @click="showMobileMenu = false"
        >
          Kalkulator
        </router-link>
        <router-link
          to="/comparison"
          class="block py-2 text-gray-700 hover:text-primary-600"
          @click="showMobileMenu = false"
        >
          Bandingkan
        </router-link>
        <router-link
          to="/blog"
          class="block py-2 text-gray-700 hover:text-primary-600"
          @click="showMobileMenu = false"
        >
          Artikel
        </router-link>
        <router-link
          to="/ojk-check"
          class="block py-2 text-gray-700 hover:text-primary-600"
          @click="showMobileMenu = false"
        >
          Cek OJK
        </router-link>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import BaseButton from '@/components/BaseButton.vue'

const router = useRouter()
const authStore = useAuthStore()
const showUserMenu = ref(false)
const showMobileMenu = ref(false)

async function handleLogout() {
  await authStore.logout()
  showUserMenu.value = false
  router.push('/')
}
</script>
