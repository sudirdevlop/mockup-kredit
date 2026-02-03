import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '@/services/api'

export const useProductStore = defineStore('products', () => {
  const products = ref([])
  const currentProduct = ref(null)
  const loading = ref(false)
  const error = ref(null)
  const filters = ref({
    category: '',
    minRate: null,
    maxRate: null,
    minAmount: null,
    maxAmount: null,
    bank: ''
  })

  const filteredProducts = computed(() => {
    let result = products.value

    if (filters.value.category) {
      result = result.filter(p => p.category === filters.value.category)
    }
    if (filters.value.bank) {
      result = result.filter(p => p.bank_name === filters.value.bank)
    }
    if (filters.value.minRate) {
      result = result.filter(p => p.interest_rate >= filters.value.minRate)
    }
    if (filters.value.maxRate) {
      result = result.filter(p => p.interest_rate <= filters.value.maxRate)
    }

    return result
  })

  async function fetchProducts() {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/products')
      products.value = response.data
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch products'
    } finally {
      loading.value = false
    }
  }

  async function fetchProduct(id) {
    loading.value = true
    error.value = null
    try {
      const response = await api.get(`/products/${id}`)
      currentProduct.value = response.data
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch product'
    } finally {
      loading.value = false
    }
  }

  function setFilters(newFilters) {
    filters.value = { ...filters.value, ...newFilters }
  }

  function resetFilters() {
    filters.value = {
      category: '',
      minRate: null,
      maxRate: null,
      minAmount: null,
      maxAmount: null,
      bank: ''
    }
  }

  return {
    products,
    currentProduct,
    loading,
    error,
    filters,
    filteredProducts,
    fetchProducts,
    fetchProduct,
    setFilters,
    resetFilters
  }
})
