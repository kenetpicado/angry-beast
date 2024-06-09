<script setup>
defineProps(['text'])
</script>

<template>
  <button
    type="button"
    class="border border-primary text-primary bg-white rounded-md inline-flex items-center justify-center gap-2 py-3 px-6 text-center font-medium hover:bg-opacity-90 lg:px-8"
  >
    {{ text }}
  </button>
</template>
