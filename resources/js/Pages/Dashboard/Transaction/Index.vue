<script setup>
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconTrash } from '@tabler/icons-vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date'
import useTransaction from '@/Composables/useTransaction'

defineProps(['transactions'])
const { destroy } = useTransaction({})
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Transacciones</h2>
    </div>

    <TableSection>
      <template #header>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Concepto</th>
        <th>Descripcion</th>
        <th>Cantidad</th>
        <th>Monto</th>
        <th>Total</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="transactions.data.length == 0">
          <td class="text-center text-slate-400" colspan="7">No hay datos que mostrar</td>
        </tr>
        <tr v-for="item in transactions.data" :key="item.id">
          <td>
            {{ getFormattedDate(item.created_at) }}
          </td>
          <td>
            <span :class="[item.type == 'INGRESO' ? 'badge-primary' : 'badge-red']">
              {{ item.type }}
            </span>
          </td>
          <td>
            {{ item.model.name }}
          </td>
          <td>
            {{ item.description }}
          </td>
          <td>
            {{ item.quantity }}
          </td>
          <td>C${{ item.value }}</td>
          <td class="font-bold">C${{ (item.quantity * item.value).toLocaleString() }}</td>
          <td>
            <div class="flex gap-4">
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="transactions.links" />
      </template>
    </TableSection>
  </DefaultLayout>
</template>
