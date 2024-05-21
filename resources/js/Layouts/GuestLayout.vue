<script setup>
defineProps(['title', 'subtitle', 'description'])
</script>

<template>
  <div class="grid place-content-center min-h-screen">
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 xl:p-10">
      <div class="rounded-md border border-stroke bg-white h-full">
        <div class="flex flex-wrap items-center">
          <div class="hidden w-full xl:block xl:w-1/2 grid place-content-center min-w-30">
            <div class="px-20">
              <slot name="left"></slot>
            </div>
          </div>
          <div class="w-full border-stroke xl:w-1/2 xl:border-l-2">
            <div class="w-full p-5 sm:p-8 xl:p-10">
              <span class="mb-2 block font-medium">
                {{ subtitle }}
              </span>
              <h2 class="mb-5 text-2xl font-bold text-slate-600 sm:text-title-xl2">
                {{ title }}
              </h2>
              <slot></slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
