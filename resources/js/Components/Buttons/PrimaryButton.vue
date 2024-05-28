<script setup>
defineProps({
  text: {
    required: true
  },
  disabled: {
    default: false
  },
  type: {
    default: 'button'
  },
  loading: {
    default: false
  }
})
</script>

<template>
  <button :type="type" :disabled="disabled || loading"
    :class="[loading ? 'cursor-not-allowed opacity-75' : 'cursor-pointer']"
    class="border border-primary bg-primary text-white rounded-md inline-flex items-center justify-center gap-2 py-3 px-6 text-center font-medium hover:bg-opacity-90 lg:px-8 focus:border-primary">

    <div v-if="loading"
      class="h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent motion-reduce:animate-[spin_1.5s_linear_infinite]"
      role="status">
    </div>

    {{ text }}
  </button>
</template>
