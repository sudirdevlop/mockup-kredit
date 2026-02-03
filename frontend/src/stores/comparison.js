import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useComparisonStore = defineStore('comparison', () => {
  const comparisonList = ref([])
  const maxItems = 4

  const canAddMore = computed(() => comparisonList.value.length < maxItems)
  const itemCount = computed(() => comparisonList.value.length)

  function addToComparison(product) {
    if (comparisonList.value.length >= maxItems) {
      return { success: false, message: `Maximum ${maxItems} products can be compared` }
    }

    const exists = comparisonList.value.find(p => p.id === product.id)
    if (exists) {
      return { success: false, message: 'Product already in comparison' }
    }

    comparisonList.value.push(product)
    saveToLocalStorage()
    return { success: true }
  }

  function removeFromComparison(productId) {
    comparisonList.value = comparisonList.value.filter(p => p.id !== productId)
    saveToLocalStorage()
  }

  function clearComparison() {
    comparisonList.value = []
    saveToLocalStorage()
  }

  function isInComparison(productId) {
    return comparisonList.value.some(p => p.id === productId)
  }

  function saveToLocalStorage() {
    localStorage.setItem('comparison', JSON.stringify(comparisonList.value))
  }

  function loadFromLocalStorage() {
    const saved = localStorage.getItem('comparison')
    if (saved) {
      try {
        comparisonList.value = JSON.parse(saved)
      } catch (err) {
        console.error('Failed to load comparison from localStorage:', err)
      }
    }
  }

  return {
    comparisonList,
    maxItems,
    canAddMore,
    itemCount,
    addToComparison,
    removeFromComparison,
    clearComparison,
    isInComparison,
    loadFromLocalStorage
  }
})
