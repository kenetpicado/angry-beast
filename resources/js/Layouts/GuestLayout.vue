<script setup>
defineProps(['title', 'subtitle', 'description'])
</script>

<template>
  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full lg:max-w-lg">
      <div class="w-full p-10">
        <span v-if="subtitle" class="mb-2 block font-medium">
          {{ subtitle }}
        </span>
        <h2 class="mb-5 text-2xl font-bold text-slate-600 sm:text-title-xl2">
          {{ title }}
        </h2>
        <slot></slot>
      </div>
    </div>
  </div>
</template>
