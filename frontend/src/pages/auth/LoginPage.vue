<template>
  <AuthLayout>
    <h2 class="text-2xl font-bold text-center mb-6">Masuk ke Akun Anda</h2>
    
    <form @submit.prevent="handleLogin">
      <BaseInput
        v-model="form.email"
        label="Email"
        type="email"
        placeholder="nama@email.com"
        :error="errors.email"
        required
      />
      
      <BaseInput
        v-model="form.password"
        label="Password"
        type="password"
        placeholder="Masukkan password"
        :error="errors.password"
        required
      />
      
      <div class="flex items-center justify-between mb-6">
        <label class="flex items-center">
          <input type="checkbox" v-model="form.remember" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
          <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
        </label>
        <router-link to="/forgot-password" class="text-sm text-primary-600 hover:text-primary-700">
          Lupa password?
        </router-link>
      </div>
      
      <BaseButton
        type="submit"
        variant="primary"
        :loading="loading"
        full-width
        class="mb-4"
      >
        Masuk
      </BaseButton>
      
      <p class="text-center text-sm text-gray-600">
        Belum punya akun?
        <router-link to="/register" class="text-primary-600 hover:text-primary-700 font-medium">
          Daftar sekarang
        </router-link>
      </p>
    </form>
  </AuthLayout>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import AuthLayout from '@/layouts/AuthLayout.vue'
import BaseInput from '@/components/BaseInput.vue'
import BaseButton from '@/components/BaseButton.vue'

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()

const loading = ref(false)
const form = reactive({
  email: '',
  password: '',
  remember: false
})
const errors = reactive({
  email: '',
  password: ''
})

async function handleLogin() {
  errors.email = ''
  errors.password = ''
  
  if (!form.email) {
    errors.email = 'Email harus diisi'
    return
  }
  if (!form.password) {
    errors.password = 'Password harus diisi'
    return
  }
  
  loading.value = true
  const success = await authStore.login({
    email: form.email,
    password: form.password
  })
  
  if (success) {
    const redirect = route.query.redirect || '/dashboard'
    router.push(redirect)
  } else {
    errors.password = authStore.error || 'Login gagal'
  }
  loading.value = false
}
</script>
