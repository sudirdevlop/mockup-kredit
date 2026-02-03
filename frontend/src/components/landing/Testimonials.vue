<template>
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Testimoni Pengguna</h2>
        <p class="text-lg text-gray-600">Dengarkan pengalaman pengguna yang telah terbantu</p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div v-for="testimonial in testimonials" :key="testimonial.id" class="bg-gray-50 rounded-xl p-6">
          <div class="flex items-center mb-4">
            <div v-for="i in 5" :key="i" class="text-yellow-400">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
          </div>
          
          <p class="text-gray-700 mb-6">{{ testimonial.content }}</p>
          
          <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold">
              {{ testimonial.avatar }}
            </div>
            <div class="ml-4">
              <div class="font-semibold text-gray-900">{{ testimonial.name }}</div>
              <div class="text-sm text-gray-600">{{ testimonial.role }}</div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center">
          <div class="text-4xl font-bold text-primary-600 mb-2">50+</div>
          <div class="text-gray-600">Bank Partner</div>
        </div>
        <div class="text-center">
          <div class="text-4xl font-bold text-primary-600 mb-2">10K+</div>
          <div class="text-gray-600">Pengajuan Sukses</div>
        </div>
        <div class="text-center">
          <div class="text-4xl font-bold text-primary-600 mb-2">5T+</div>
          <div class="text-gray-600">Dana Tersalurkan</div>
        </div>
        <div class="text-center">
          <div class="text-4xl font-bold text-primary-600 mb-2">95%</div>
          <div class="text-gray-600">Tingkat Kepuasan</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const testimonials = [
  {
    id: 1,
    name: 'Budi Santoso',
    role: 'Karyawan Swasta',
    avatar: 'BS',
    content: 'Proses pengajuan KPR sangat mudah dan cepat. Dalam 2 minggu kredit saya sudah disetujui. Terima kasih KreditHub!'
  },
  {
    id: 2,
    name: 'Siti Nurhaliza',
    role: 'Wiraswasta',
    avatar: 'SN',
    content: 'Platform yang sangat membantu untuk membandingkan berbagai produk kredit. Saya bisa memilih yang paling sesuai dengan kebutuhan.'
  },
  {
    id: 3,
    name: 'Ahmad Fauzi',
    role: 'Pengusaha',
    avatar: 'AF',
    content: 'Pelayanan customer service sangat responsif. Semua pertanyaan saya dijawab dengan jelas dan detail.'
  }
]
</script>
