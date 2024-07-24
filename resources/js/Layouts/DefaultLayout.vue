<script setup>
import HeaderArea from '@/Components/Header/HeaderArea.vue'
import SidebarArea from '@/Components/Sidebar/SidebarArea.vue'
import { Head } from '@inertiajs/vue3'
defineProps(['head'])
</script>

<template>
  <div class="flex h-screen overflow-hidden bg-slate-100">
    <SidebarArea />
    <Head :title="head" />
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <HeaderArea />
      <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <slot></slot>
        </div>
      </main>
    </div>
  </div>
</template>
