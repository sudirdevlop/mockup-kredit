<template>
  <div class="min-h-screen bg-gradient-to-br from-primary-50 to-secondary-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <router-link to="/" class="inline-block">
          <h1 class="text-3xl font-bold text-primary-600">KreditHub</h1>
        </router-link>
      </div>
      <div class="bg-white rounded-lg shadow-xl p-8">
        <slot />
      </div>
      <p class="text-center text-sm text-gray-600 mt-4">
        &copy; 2024 KreditHub. All rights reserved.
      </p>
    </div>
  </div>
</template>

<script setup>
</script>
