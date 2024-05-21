<script setup>
import { router } from '@inertiajs/vue3'
import { IconChevronLeft, IconChevronRight } from '@tabler/icons-vue'

defineProps(['links'])

function getThisPage(url) {
  router.get(
    url,
    {},
    {
      preserveState: true,
      preserveScroll: true
    }
  )
}
</script>

<template>
  <div class="flex items-center gap-3 my-4 w-full justify-center" v-if="links.length > 3">
    <template v-for="(link, index) in links" :key="index">
      <button
        v-if="link.url"
        type="button"
        @click.prevent="getThisPage(link.url)"
        :class="[
          link.active ? 'bg-primary border-primary text-white' : 'border-slate-300 text-slate-400'
        ]"
        class="w-8 h-8 select-none rounded-md font-medium border border-2 text-xs flex items-center justify-center"
      >
        <span v-if="index == 0">
          <IconChevronLeft size="20" />
        </span>
        <span v-else-if="index == links.length - 1">
          <IconChevronRight size="20" />
        </span>
        <span v-else class="cursor-pointer">{{ link.label }}</span>
      </button>
    </template>
  </div>
</template>
