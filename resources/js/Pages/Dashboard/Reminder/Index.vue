<script setup>
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconTrash } from '@tabler/icons-vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import useEvent from '@/Composables/useEvent.js'
import getFormattedDate from '@/Utils/date.js'

defineProps(['reminders'])

</script>

<template>
  <DefaultLayout head="Tipos de eventos">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Reminders</h2>
    </div>

    <TableSection>
      <template #header>
        <th>Evento</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Creado</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="reminders.data.length == 0">
          <td class="text-center" colspan="4">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in reminders.data" :key="item.id">
          <td>
            {{ item.event.name }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            {{ getFormattedDate(item.date, 'DD/MM/YY') }}
          </td>
          <td>
            {{ getFormattedDate(item.created_at) }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="reminders.links" />
      </template>
    </TableSection>
  </DefaultLayout>
</template>
