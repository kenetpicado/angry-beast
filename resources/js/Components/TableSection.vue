<template>
  <div class="bg-white rounded-md flex flex-col border">
    <div class="max-w-full overflow-x-auto">
      <table class="w-full table-auto text-left text-sm border-collapse" :class="tableClass">
        <thead class="uppercase">
          <tr>
            <slot name="header"></slot>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 border-t border-slate-100">
          <slot name="body"></slot>
        </tbody>
      </table>
    </div>
    <slot name="footer"></slot>
  </div>
</template>

<script setup>
defineProps(['tableClass'])
</script>
