<template>
  <router-view />
</template>

<script setup>
import { onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useComparisonStore } from '@/stores/comparison'
import { usePreferencesStore } from '@/stores/preferences'

const authStore = useAuthStore()
const comparisonStore = useComparisonStore()
const preferencesStore = usePreferencesStore()

onMounted(() => {
  if (authStore.token) {
    authStore.fetchUser()
  }
  comparisonStore.loadFromLocalStorage()
  preferencesStore.loadPreferences()
})
</script>
