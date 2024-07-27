<template>
  <div class="rounded-md bg-white p-4 border">
    <component :is="item.icon" class="h-6 w-6" stroke="2" />

    <div class="mt-2 flex items-end justify-between">
      <div>
        <h4 class="text-2xl font-bold">
          {{ item.value }}
        </h4>
        <span class="text-base font-medium">
          {{ item.title }}
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps(['item'])
</script>
