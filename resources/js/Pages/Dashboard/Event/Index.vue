<script setup>
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconTrash } from '@tabler/icons-vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import useEvent from "@/Composables/useEvent.js"

defineProps(['events'])
const { destroyEvent } = useEvent({})

</script>

<template>
  <DefaultLayout head="Tipos de eventos">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Eventos</h2>
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="events.data.length == 0">
          <td class="text-center" colspan="3">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in events.data" :key="item.id">
          <td>
            {{ index + 1 + (events.current_page - 1) * events.per_page }}
          </td>
          <td>
            {{ item.model?.name }}
          </td>
          <td>
            {{ item.description }}
          </td>
          <td>
            {{ item.quantity }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon :icon="IconTrash" @click="destroyEvent(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="events.links" />
      </template>
    </TableSection>
  </DefaultLayout>
</template>
