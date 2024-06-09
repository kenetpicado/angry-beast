<template>
  <div class="bg-white mb-4 rounded-md flex gap-4 items-center p-4">
    <button
      @click="model = option.value"
      v-for="option in options"
      type="button"
      class="flex items-center gap-1 rounded-md"
      :key="option"
      :class="[model == option.value ? 'text-primary' : 'text-gray-400']"
    >
      <span class="p-1.5 rounded-lg" :class="[model == option.value ? 'bg-primary' : '']">
        <component
          :is="option.icon"
          size="18"
          stroke="2"
          :class="[model == option.value ? 'text-white' : '']"
        />
      </span>

      {{ option.label }}
    </button>
  </div>
</template>

<script setup>
defineProps(['options'])
const model = defineModel()
</script>
