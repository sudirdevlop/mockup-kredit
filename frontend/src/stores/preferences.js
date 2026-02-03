import { defineStore } from 'pinia'
import { ref } from 'vue'

export const usePreferencesStore = defineStore('preferences', () => {
  const theme = ref('light')
  const language = ref('id')
  const notifications = ref({
    email: true,
    sms: false,
    push: true
  })

  function setTheme(newTheme) {
    theme.value = newTheme
    localStorage.setItem('theme', newTheme)
    document.documentElement.classList.toggle('dark', newTheme === 'dark')
  }

  function setLanguage(lang) {
    language.value = lang
    localStorage.setItem('language', lang)
  }

  function updateNotifications(settings) {
    notifications.value = { ...notifications.value, ...settings }
    localStorage.setItem('notifications', JSON.stringify(notifications.value))
  }

  function loadPreferences() {
    const savedTheme = localStorage.getItem('theme')
    if (savedTheme) {
      setTheme(savedTheme)
    }

    const savedLanguage = localStorage.getItem('language')
    if (savedLanguage) {
      language.value = savedLanguage
    }

    const savedNotifications = localStorage.getItem('notifications')
    if (savedNotifications) {
      try {
        notifications.value = JSON.parse(savedNotifications)
      } catch (err) {
        console.error('Failed to load notifications:', err)
      }
    }
  }

  return {
    theme,
    language,
    notifications,
    setTheme,
    setLanguage,
    updateNotifications,
    loadPreferences
  }
})
