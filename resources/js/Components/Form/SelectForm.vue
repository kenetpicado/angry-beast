<script setup>
import { computed } from 'vue'

const props = defineProps({
  label: {
    default: 'select'
  },
  autofocus: {
    default: false
  },
  disabled: {
    default: false
  },
  required: {
    default: false
  },
  modelValue: {
    type: [String, Number],
    required: false
  },
  name: {
    required: false
  }
})

const keyValue = computed(() => {
  return props.name ?? format_key(props.label)
})

function format_key(string) {
  return string.toLowerCase().replace(/ /g, '_')
}
</script>

<template>
  <div class="mb-4">
    <label class="mb-2 block font-medium">{{ label }}</label>

    <div class="relative">
      <select
        :disabled="disabled"
        :autofocus="autofocus"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        :value="modelValue"
        style="appearance: none"
        class="w-full rounded-md border border-slate-300 bg-white py-3 pl-5 pr-10 text-slate-600 focus:border-green-600 focus:ring-green-600"
      >
        <slot></slot>
      </select>
    </div>
    <div class="text-red-400 mt-2 text-xs" v-if="$page.props.errors[keyValue]">
      {{ $page.props.errors[keyValue] }}
    </div>
  </div>
</template>
