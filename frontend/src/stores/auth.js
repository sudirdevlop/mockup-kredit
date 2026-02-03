import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '@/services/api'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null)
  const token = ref(localStorage.getItem('token') || null)
  const loading = ref(false)
  const error = ref(null)

  const isAuthenticated = computed(() => !!token.value)
  const isAdmin = computed(() => user.value?.role === 'admin')

  async function login(credentials) {
    loading.value = true
    error.value = null
    try {
      const response = await api.post('/auth/login', credentials)
      token.value = response.data.token
      user.value = response.data.user
      localStorage.setItem('token', token.value)
      return true
    } catch (err) {
      error.value = err.response?.data?.message || 'Login failed'
      return false
    } finally {
      loading.value = false
    }
  }

  async function register(userData) {
    loading.value = true
    error.value = null
    try {
      const response = await api.post('/auth/register', userData)
      token.value = response.data.token
      user.value = response.data.user
      localStorage.setItem('token', token.value)
      return true
    } catch (err) {
      error.value = err.response?.data?.message || 'Registration failed'
      return false
    } finally {
      loading.value = false
    }
  }

  async function logout() {
    try {
      await api.post('/auth/logout')
    } catch (err) {
      console.error('Logout error:', err)
    } finally {
      user.value = null
      token.value = null
      localStorage.removeItem('token')
    }
  }

  async function fetchUser() {
    if (!token.value) return
    
    loading.value = true
    try {
      const response = await api.get('/auth/me')
      user.value = response.data
    } catch (err) {
      console.error('Failed to fetch user:', err)
      logout()
    } finally {
      loading.value = false
    }
  }

  return {
    user,
    token,
    loading,
    error,
    isAuthenticated,
    isAdmin,
    login,
    register,
    logout,
    fetchUser
  }
})
