<template>
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Produk Kredit Pilihan</h2>
        <p class="text-lg text-gray-600">Temukan produk kredit yang sesuai dengan kebutuhan Anda</p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <button
          v-for="category in categories"
          :key="category.id"
          @click="selectedCategory = category.id"
          :class="[
            'p-6 rounded-lg border-2 transition-all text-left',
            selectedCategory === category.id
              ? 'border-primary-600 bg-primary-50'
              : 'border-gray-200 bg-white hover:border-primary-300'
          ]"
        >
          <div class="text-3xl mb-3">{{ category.icon }}</div>
          <h3 class="font-semibold text-gray-900 mb-1">{{ category.name }}</h3>
          <p class="text-sm text-gray-600">{{ category.description }}</p>
        </button>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <BaseCard v-for="product in featuredProducts" :key="product.id" hoverable>
          <template #image>
            <div class="bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center h-48">
              <span class="text-white text-4xl font-bold">{{ product.bank }}</span>
            </div>
          </template>
          
          <h3 class="text-xl font-semibold mb-2">{{ product.name }}</h3>
          <p class="text-gray-600 text-sm mb-4">{{ product.description }}</p>
          
          <div class="space-y-2 mb-4">
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Suku Bunga:</span>
              <span class="font-semibold text-primary-600">{{ product.rate }}%</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Tenor Maks:</span>
              <span class="font-semibold">{{ product.maxTenor }} tahun</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Plafon Maks:</span>
              <span class="font-semibold">{{ formatCurrency(product.maxAmount) }}</span>
            </div>
          </div>
          
          <template #footer>
            <div class="flex gap-2">
              <router-link :to="`/products/${product.id}`" class="flex-1">
                <BaseButton variant="primary" full-width>Detail</BaseButton>
              </router-link>
              <BaseButton variant="outline">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </BaseButton>
            </div>
          </template>
        </BaseCard>
      </div>
      
      <div class="text-center mt-12">
        <router-link to="/products">
          <BaseButton variant="outline" size="lg">
            Lihat Semua Produk
          </BaseButton>
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import BaseCard from '@/components/BaseCard.vue'
import BaseButton from '@/components/BaseButton.vue'
import { formatCurrency } from '@/utils/formatters'

const selectedCategory = ref('kpr')

const categories = [
  { id: 'kpr', name: 'KPR', icon: '🏠', description: 'Kredit Pemilikan Rumah' },
  { id: 'kendaraan', name: 'Kendaraan', icon: '🚗', description: 'Kredit Mobil & Motor' },
  { id: 'multiguna', name: 'Multiguna', icon: '💼', description: 'Berbagai Kebutuhan' },
  { id: 'tanpa-agunan', name: 'Tanpa Agunan', icon: '✨', description: 'KTA Tanpa Jaminan' }
]

const featuredProducts = [
  {
    id: 1,
    name: 'KPR Fixed Rate',
    bank: 'BCA',
    description: 'Kredit pemilikan rumah dengan bunga tetap 3 tahun pertama',
    rate: 7.5,
    maxTenor: 20,
    maxAmount: 5000000000
  },
  {
    id: 2,
    name: 'Kredit Mobil Baru',
    bank: 'Mandiri',
    description: 'Pembiayaan mobil baru dengan proses cepat',
    rate: 6.8,
    maxTenor: 5,
    maxAmount: 500000000
  },
  {
    id: 3,
    name: 'KTA Express',
    bank: 'BNI',
    description: 'Kredit tanpa agunan dengan approval cepat',
    rate: 12.5,
    maxTenor: 3,
    maxAmount: 200000000
  }
]
</script>
