<template>
  <div :class="['bg-white rounded-lg shadow-md overflow-hidden', { 'hover:shadow-lg transition-shadow': hoverable }]">
    <div v-if="$slots.image" class="aspect-video w-full overflow-hidden">
      <slot name="image" />
    </div>
    <div :class="['p-6', paddingClass]">
      <slot />
    </div>
    <div v-if="$slots.footer" class="px-6 py-4 bg-gray-50 border-t border-gray-200">
      <slot name="footer" />
    </div>
  </div>
</template>

<script setup>
defineProps({
  hoverable: {
    type: Boolean,
    default: false
  },
  paddingClass: {
    type: String,
    default: ''
  }
})
</script>
