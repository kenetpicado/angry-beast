<script setup>
defineProps(['text'])
</script>

<template>
  <button
    type="button"
    class="text-primary bg-white rounded-md inline-flex items-center justify-center gap-2 py-3 px-6 text-center font-medium hover:bg-opacity-90 hover:bg-slate-50 lg:px-8"
  >
    {{ text }}
  </button>
</template>
