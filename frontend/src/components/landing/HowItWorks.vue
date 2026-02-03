<template>
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Cara Kerja</h2>
        <p class="text-lg text-gray-600">Dapatkan kredit impian Anda dalam 4 langkah mudah</p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div v-for="(step, index) in steps" :key="index" class="text-center">
          <div class="relative mb-6">
            <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <span class="text-3xl">{{ step.icon }}</span>
            </div>
            <div class="absolute -top-4 -right-4 w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
              {{ index + 1 }}
            </div>
          </div>
          <h3 class="text-xl font-semibold mb-3">{{ step.title }}</h3>
          <p class="text-gray-600">{{ step.description }}</p>
        </div>
      </div>
      
      <div class="mt-16 bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-8 md:p-12 text-white text-center">
        <h3 class="text-2xl md:text-3xl font-bold mb-4">Siap Mengajukan Kredit?</h3>
        <p class="text-primary-100 mb-8 max-w-2xl mx-auto">
          Bergabunglah dengan ribuan pengguna yang telah mendapatkan kredit impian mereka melalui platform kami
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <router-link to="/register">
            <BaseButton variant="secondary" size="lg">
              Daftar Sekarang
            </BaseButton>
          </router-link>
          <router-link to="/products">
            <BaseButton variant="outline" size="lg" class="!text-white !border-white hover:!bg-white/10">
              Lihat Produk
            </BaseButton>
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import BaseButton from '@/components/BaseButton.vue'

const steps = [
  {
    icon: '🔍',
    title: 'Cari & Bandingkan',
    description: 'Bandingkan berbagai produk kredit dari bank terpercaya'
  },
  {
    icon: '📝',
    title: 'Isi Aplikasi',
    description: 'Lengkapi formulir aplikasi online dengan mudah'
  },
  {
    icon: '✅',
    title: 'Verifikasi',
    description: 'Tim kami akan memverifikasi data dan dokumen Anda'
  },
  {
    icon: '🎉',
    title: 'Pencairan',
    description: 'Kredit Anda disetujui dan dana dicairkan'
  }
]
</script>
