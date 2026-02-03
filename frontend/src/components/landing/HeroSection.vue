<template>
  <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
            Temukan Kredit Terbaik untuk Kebutuhan Anda
          </h1>
          <p class="text-xl mb-8 text-primary-100">
            Bandingkan penawaran kredit dari berbagai bank terpercaya di Indonesia. 
            Proses cepat, mudah, dan aman.
          </p>
          <div class="flex flex-col sm:flex-row gap-4">
            <router-link to="/products">
              <BaseButton size="lg" variant="secondary">
                Lihat Produk
              </BaseButton>
            </router-link>
            <router-link to="/calculator">
              <BaseButton size="lg" variant="outline" class="!text-white !border-white hover:!bg-white/10">
                Kalkulator Kredit
              </BaseButton>
            </router-link>
          </div>
          
          <div class="mt-12 grid grid-cols-3 gap-6">
            <div>
              <div class="text-3xl font-bold">50+</div>
              <div class="text-primary-100">Bank Partner</div>
            </div>
            <div>
              <div class="text-3xl font-bold">10K+</div>
              <div class="text-primary-100">Pengajuan</div>
            </div>
            <div>
              <div class="text-3xl font-bold">95%</div>
              <div class="text-primary-100">Kepuasan</div>
            </div>
          </div>
        </div>
        
        <div class="hidden lg:block">
          <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
            <h3 class="text-2xl font-semibold mb-6">Simulasi Cepat</h3>
            <div class="space-y-4">
              <div>
                <label class="block text-sm mb-2">Jumlah Pinjaman</label>
                <input
                  v-model="simulationForm.amount"
                  type="number"
                  class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/50"
                  placeholder="100000000"
                />
              </div>
              <div>
                <label class="block text-sm mb-2">Jangka Waktu (Tahun)</label>
                <input
                  v-model="simulationForm.years"
                  type="number"
                  class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/50"
                  placeholder="15"
                />
              </div>
              <div>
                <label class="block text-sm mb-2">Suku Bunga (%)</label>
                <input
                  v-model="simulationForm.rate"
                  type="number"
                  step="0.1"
                  class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/50"
                  placeholder="8.5"
                />
              </div>
              <router-link to="/calculator">
                <BaseButton variant="secondary" full-width size="lg">
                  Hitung Detail
                </BaseButton>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="absolute bottom-0 left-0 right-0">
      <svg viewBox="0 0 1440 120" class="w-full h-auto">
        <path fill="#f9fafb" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
      </svg>
    </div>
  </section>
</template>

<script setup>
import { reactive } from 'vue'
import BaseButton from '@/components/BaseButton.vue'

const simulationForm = reactive({
  amount: 100000000,
  years: 15,
  rate: 8.5
})
</script>
