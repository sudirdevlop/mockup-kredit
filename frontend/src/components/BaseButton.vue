<template>
  <button
    :type="type"
    :disabled="disabled || loading"
    :class="buttonClasses"
    @click="$emit('click', $event)"
  >
    <span v-if="loading" class="inline-block w-4 h-4 mr-2 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
    <slot />
  </button>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  variant: {
    type: String,
    default: 'primary',
    validator: (value) => ['primary', 'secondary', 'outline', 'ghost', 'danger'].includes(value)
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['sm', 'md', 'lg'].includes(value)
  },
  type: {
    type: String,
    default: 'button'
  },
  disabled: Boolean,
  loading: Boolean,
  fullWidth: Boolean
})

defineEmits(['click'])

const buttonClasses = computed(() => {
  const classes = ['inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2']
  
  if (props.fullWidth) {
    classes.push('w-full')
  }
  
  switch (props.size) {
    case 'sm':
      classes.push('px-3 py-1.5 text-sm')
      break
    case 'lg':
      classes.push('px-6 py-3 text-lg')
      break
    default:
      classes.push('px-4 py-2 text-base')
  }
  
  if (props.disabled || props.loading) {
    classes.push('opacity-50 cursor-not-allowed')
  }
  
  switch (props.variant) {
    case 'primary':
      classes.push('bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500')
      break
    case 'secondary':
      classes.push('bg-secondary-600 text-white hover:bg-secondary-700 focus:ring-secondary-500')
      break
    case 'outline':
      classes.push('border-2 border-primary-600 text-primary-600 hover:bg-primary-50 focus:ring-primary-500')
      break
    case 'ghost':
      classes.push('text-gray-700 hover:bg-gray-100 focus:ring-gray-500')
      break
    case 'danger':
      classes.push('bg-red-600 text-white hover:bg-red-700 focus:ring-red-500')
      break
  }
  
  return classes.join(' ')
})
</script>
