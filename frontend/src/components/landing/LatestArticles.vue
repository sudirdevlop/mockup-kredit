<template>
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center mb-12">
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-2">Artikel Terbaru</h2>
          <p class="text-lg text-gray-600">Tips dan panduan seputar kredit</p>
        </div>
        <router-link to="/blog">
          <BaseButton variant="outline">Lihat Semua</BaseButton>
        </router-link>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <BaseCard v-for="article in articles" :key="article.id" hoverable>
          <template #image>
            <img :src="article.image" :alt="article.title" class="w-full h-full object-cover" />
          </template>
          
          <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
            <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-xs font-medium">
              {{ article.category }}
            </span>
            <span>{{ article.date }}</span>
          </div>
          
          <h3 class="text-lg font-semibold mb-2 line-clamp-2">{{ article.title }}</h3>
          <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ article.excerpt }}</p>
          
          <router-link :to="`/blog/${article.id}`" class="text-primary-600 hover:text-primary-700 font-medium text-sm flex items-center gap-1">
            Baca Selengkapnya
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </router-link>
        </BaseCard>
      </div>
    </div>
  </section>
</template>

<script setup>
import BaseCard from '@/components/BaseCard.vue'
import BaseButton from '@/components/BaseButton.vue'

const articles = [
  {
    id: 1,
    title: 'Panduan Lengkap Mengajukan KPR untuk Rumah Pertama',
    excerpt: 'Pelajari langkah-langkah penting dalam mengajukan KPR, dari persiapan dokumen hingga approval.',
    category: 'KPR',
    date: '15 Jan 2024',
    image: 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=400&h=300&fit=crop'
  },
  {
    id: 2,
    title: 'Tips Memilih Kredit Kendaraan dengan Bunga Rendah',
    excerpt: 'Bandingkan suku bunga dan temukan penawaran terbaik untuk kredit kendaraan Anda.',
    category: 'Kendaraan',
    date: '12 Jan 2024',
    image: 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=400&h=300&fit=crop'
  },
  {
    id: 3,
    title: 'Cara Meningkatkan Peluang Approval KTA',
    excerpt: 'Ketahui faktor-faktor yang mempengaruhi persetujuan kredit tanpa agunan Anda.',
    category: 'Tips',
    date: '10 Jan 2024',
    image: 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400&h=300&fit=crop'
  }
]
</script>
