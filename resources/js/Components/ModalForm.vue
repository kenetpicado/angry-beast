<template>
  <Modal v-model="openModal" class="z-30">
    <form
      class="bg-white rounded-md px-7 py-5 w-full flex flex-col"
      style="max-width: 50rem; min-height: 20rem"
      @submit.prevent="$emit('onSubmit')"
    >
      <h2 class="text-xl font-semibold mb-5">{{ title }}</h2>
      <div class="flex-1 mb-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <slot></slot>
        </div>
      </div>
      <div class="flex gap-3 items-center justify-end">
        <SecondaryButton text="Cancelar" @click="$emit('onCancel')" />
        <PrimaryButton text="Guardar" type="submit" />
      </div>
    </form>
  </Modal>
</template>

<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'

const openModal = defineModel()
defineEmits(['onSubmit', 'onCancel'])
defineProps(['title'])
</script>
