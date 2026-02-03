<template>
  <div class="mb-4">
    <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 mb-1">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <div class="relative">
      <input
        :id="id"
        :type="type"
        :value="modelValue"
        :placeholder="placeholder"
        :disabled="disabled"
        :required="required"
        :class="inputClasses"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur')"
      />
      <div v-if="$slots.icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <slot name="icon" />
      </div>
    </div>
    <p v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>
    <p v-else-if="hint" class="mt-1 text-sm text-gray-500">{{ hint }}</p>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  id: String,
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  modelValue: [String, Number],
  placeholder: String,
  disabled: Boolean,
  required: Boolean,
  error: String,
  hint: String
})

defineEmits(['update:modelValue', 'blur'])

const inputClasses = computed(() => {
  const classes = [
    'block w-full rounded-lg border px-3 py-2 transition-colors',
    'focus:outline-none focus:ring-2 focus:ring-primary-500',
    'disabled:bg-gray-100 disabled:cursor-not-allowed'
  ]
  
  if (props.error) {
    classes.push('border-red-300 text-red-900 placeholder-red-300 focus:border-red-500')
  } else {
    classes.push('border-gray-300 focus:border-primary-500')
  }
  
  return classes.join(' ')
})
</script>
