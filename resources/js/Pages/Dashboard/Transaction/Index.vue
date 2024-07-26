<script setup>
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconTrash } from '@tabler/icons-vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date'
import useTransaction from '@/Composables/useTransaction'
import { reactive, computed } from "vue"
import InputForm from '@/Components/Form/InputForm.vue'
import SelectForm from '@/Components/Form/SelectForm.vue'
import { watchDebounced } from '@vueuse/core'
import { router } from '@inertiajs/vue3'
import Card from '@/Components/Card.vue'
import { IconInfoCircle, IconArrowBigUp, IconArrowBigDown } from '@tabler/icons-vue'

defineProps(['transactions'])
const { destroy } = useTransaction({})

const urlSearchParams = new URLSearchParams(window.location.search)

const queryParams = reactive({
  type: urlSearchParams.get('type') ?? '',
  from: urlSearchParams.get('from') ?? '',
  to: urlSearchParams.get('to') ?? '',
  search: urlSearchParams.get('search') ?? '',
})

watchDebounced(
  queryParams,
  () => {
    let params = { ...queryParams }

    for (const key in params) {
      if (!params[key]) delete params[key]
    }

    router.get(route('dashboard.transactions.index'), params, {
      preserveState: true,
      preserveScroll: true,
      only: ['transactions'],
      replace: false
    })
  },
  { debounce: 500, maxWait: 1000 }
)

const cards = computed(() => {
  return [
    {
      title: 'Ingresos (20)',
      value: 'C$ 20',
      icon: IconArrowBigDown
    },
    {
      title: 'Egresos (39)',
      value: 'C$ 2',
      icon: IconArrowBigUp
    },
  ]
})

</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Transacciones</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mb-3">
      <InputForm v-model="queryParams.from" label="Desde" type="date" />
      <InputForm v-model="queryParams.to" label="Hasta" type="date" />
      <SelectForm v-model="queryParams.type" label="Tipo" name="type" required>
        <option value="" selected>Todos</option>
        <option value="INGRESO">Ingreso</option>
        <option value="EGRESO">Egresos</option>
      </SelectForm>
      <InputForm
        v-model="queryParams.search"
        label="Buscar"
        type="search"
        placeholder="Buscar descripción"
      />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-3">
      <Card v-for="(card, index) in cards" :key="index" :item="card" />
    </div>

    <TableSection>
      <template #header>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Concepto</th>
        <th>Descripción</th>
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
