<template>
  <AdminLayout>
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-gray-500 text-sm mb-2">Total Pengajuan</div>
        <div class="text-3xl font-bold text-gray-900">150</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-gray-500 text-sm mb-2">Pending</div>
        <div class="text-3xl font-bold text-yellow-600">25</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-gray-500 text-sm mb-2">Approved</div>
        <div class="text-3xl font-bold text-green-600">100</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-gray-500 text-sm mb-2">Rejected</div>
        <div class="text-3xl font-bold text-red-600">25</div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
</script>
