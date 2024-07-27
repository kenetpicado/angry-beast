<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import Card from '@/Components/Card.vue'
import { IconInfoCircle, IconArrowBigUp, IconArrowBigDown } from '@tabler/icons-vue'

const props = defineProps(['month', 'stats'])

const months = [
  'enero',
  'febrero',
  'marzo',
  'abril',
  'mayo',
  'junio',
  'julio',
  'agosto',
  'septiembre',
  'octubre',
  'noviembre',
  'diciembre'
]

const cards = [
  {
    title: 'Ingresos ' + months[props.month - 1],
    value: 'C$ ' + props.stats['ingresos'].toLocaleString(),
    icon: IconInfoCircle
  },
  {
    title: 'Egresos ' + months[props.month - 1],
    value: 'C$ ' + props.stats['egresos'].toLocaleString(),
    icon: IconInfoCircle
  },
  {
    title: 'Recordatorios para hoy',
    value: props.stats['reminders_count'] ?? 0,
    icon: IconInfoCircle
  }
]
</script>

<template>
  <DefaultLayout head="Inicio">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-3">
      <Card v-for="(card, index) in cards" :key="index" :item="card" />
    </div>
  </DefaultLayout>
</template>
