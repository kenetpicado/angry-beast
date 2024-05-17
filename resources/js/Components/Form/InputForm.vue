<script setup>
import { computed } from 'vue'

const props = defineProps({
  type: {
    default: 'text'
  },
  label: {
    default: 'input'
  },
  placeholder: {
    required: false
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
    <label class="mb-1 block font-medium">{{ label }}</label>

    <div class="relative">
      <input
        :disabled="disabled"
        :placeholder="placeholder"
        :type="type"
        :autofocus="autofocus"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        :value="modelValue"
        class="w-full rounded-lg border border-slate-300 bg-transparent py-3 pl-5 pr-10 outline-none focus:ring-2 focus:ring-green-600 text-black"
      />

      <span class="absolute right-4 top-3">
        <slot></slot>
      </span>
    </div>
    <div class="text-red-400 mt-2 text-xs" v-if="$page.props.errors[keyValue]">
      {{ $page.props.errors[keyValue] }}
    </div>
  </div>
</template>
