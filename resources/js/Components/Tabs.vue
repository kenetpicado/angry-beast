<template>
  <div class="bg-white mb-4 rounded-md flex gap-4 items-center p-4">
    <button
      @click="model = option.value"
      v-for="option in options"
      type="button"
      class="flex items-center gap-1 rounded-md mr-2"
      :key="option"
      :class="[model == option.value ? 'text-primary' : 'text-gray-400']"
    >
      <component :is="option.icon" size="20" stroke="2" />
      {{ option.label }}
    </button>
  </div>
</template>

<script setup>
defineProps(['options'])
const model = defineModel()
</script>
