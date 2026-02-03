<template>
  <AuthLayout>
    <h2 class="text-2xl font-bold text-center mb-6">Buat Akun Baru</h2>
    
    <form @submit.prevent="handleRegister">
      <BaseInput
        v-model="form.name"
        label="Nama Lengkap"
        type="text"
        placeholder="Nama lengkap Anda"
        :error="errors.name"
        required
      />
      
      <BaseInput
        v-model="form.email"
        label="Email"
        type="email"
        placeholder="nama@email.com"
        :error="errors.email"
        required
      />
      
      <BaseInput
        v-model="form.phone"
        label="Nomor Telepon"
        type="tel"
        placeholder="08xxxxxxxxxx"
        :error="errors.phone"
        required
      />
      
      <BaseInput
        v-model="form.password"
        label="Password"
        type="password"
        placeholder="Minimal 8 karakter"
        :error="errors.password"
        :hint="passwordHint"
        required
      />
      
      <BaseInput
        v-model="form.password_confirmation"
        label="Konfirmasi Password"
        type="password"
        placeholder="Ulangi password"
        :error="errors.password_confirmation"
        required
      />
      
      <div class="mb-6">
        <label class="flex items-start">
          <input type="checkbox" v-model="form.agree" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 mt-1">
          <span class="ml-2 text-sm text-gray-600">
            Saya setuju dengan
            <router-link to="/terms" class="text-primary-600 hover:text-primary-700">Syarat & Ketentuan</router-link>
            dan
            <router-link to="/privacy" class="text-primary-600 hover:text-primary-700">Kebijakan Privasi</router-link>
          </span>
        </label>
        <p v-if="errors.agree" class="mt-1 text-sm text-red-600">{{ errors.agree }}</p>
      </div>
      
      <BaseButton
        type="submit"
        variant="primary"
        :loading="loading"
        full-width
        class="mb-4"
      >
        Daftar
      </BaseButton>
      
      <p class="text-center text-sm text-gray-600">
        Sudah punya akun?
        <router-link to="/login" class="text-primary-600 hover:text-primary-700 font-medium">
          Masuk
        </router-link>
      </p>
    </form>
  </AuthLayout>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { validateEmail, validatePhone } from '@/utils/validators'
import AuthLayout from '@/layouts/AuthLayout.vue'
import BaseInput from '@/components/BaseInput.vue'
import BaseButton from '@/components/BaseButton.vue'

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(false)
const form = reactive({
  name: '',
  email: '',
  phone: '',
  password: '',
  password_confirmation: '',
  agree: false
})
const errors = reactive({
  name: '',
  email: '',
  phone: '',
  password: '',
  password_confirmation: '',
  agree: ''
})

const passwordHint = computed(() => {
  if (!form.password) return ''
  if (form.password.length < 8) return 'Password minimal 8 karakter'
  return 'Password cukup kuat'
})

async function handleRegister() {
  Object.keys(errors).forEach(key => errors[key] = '')
  
  if (!form.name) {
    errors.name = 'Nama harus diisi'
    return
  }
  if (!form.email) {
    errors.email = 'Email harus diisi'
    return
  }
  if (!validateEmail(form.email)) {
    errors.email = 'Format email tidak valid'
    return
  }
  if (!form.phone) {
    errors.phone = 'Nomor telepon harus diisi'
    return
  }
  if (!validatePhone(form.phone)) {
    errors.phone = 'Format nomor telepon tidak valid'
    return
  }
  if (!form.password) {
    errors.password = 'Password harus diisi'
    return
  }
  if (form.password.length < 8) {
    errors.password = 'Password minimal 8 karakter'
    return
  }
  if (form.password !== form.password_confirmation) {
    errors.password_confirmation = 'Password tidak cocok'
    return
  }
  if (!form.agree) {
    errors.agree = 'Anda harus menyetujui syarat & ketentuan'
    return
  }
  
  loading.value = true
  const success = await authStore.register({
    name: form.name,
    email: form.email,
    phone: form.phone,
    password: form.password,
    password_confirmation: form.password_confirmation
  })
  
  if (success) {
    router.push('/dashboard')
  } else {
    errors.email = authStore.error || 'Pendaftaran gagal'
  }
  loading.value = false
}
</script>
