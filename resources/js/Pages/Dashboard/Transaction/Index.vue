<script setup>
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconTrash } from '@tabler/icons-vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date'
import useTransaction from '@/Composables/useTransaction'
import { reactive, watch } from 'vue'
import InputForm from '@/Components/Form/InputForm.vue'
import transaction_type from '@/Utils/types.js'
import SelectForm from '@/Components/Form/SelectForm.vue'
import { router } from '@inertiajs/vue3'
import { watchDebounced } from '@vueuse/core'

defineProps(['transactions', 'concepts'])
const { destroy } = useTransaction({})

const urlSearchParams = new URLSearchParams(window.location.search)

const queryParams = reactive({
  type: urlSearchParams.get('type') || '',
  model_id: urlSearchParams.get('model_id') || '',
  search: urlSearchParams.get('search') || '',
  from: urlSearchParams.get('from') || '',
  to: urlSearchParams.get('to') || ''
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
      replace: true
    })
  },
  { debounce: 500, maxWait: 1000 }
)
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Transacciones</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mb-3">
      <SelectForm v-model="queryParams.type" label="Tipo" name="type" required>
        <option value="" selected>Todos</option>
        <option v-for="item in transaction_type" :key="item" :value="item">
          {{ item }}
        </option>
      </SelectForm>
      <SelectForm v-model="queryParams.model_id" label="Concepto" name="model_id">
        <option value="" selected>Todos</option>
        <option v-for="item in concepts" :key="item" :value="item.id">
          {{ item.name }}
        </option>
      </SelectForm>
      <InputForm v-model="queryParams.from" label="Desde" type="date" />
      <InputForm v-model="queryParams.to" label="Hasta" type="date" />
      <InputForm
        v-model="queryParams.search"
        label="Buscar"
        type="search"
        placeholder="Buscar descripcion"
      />
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
          <td class="text-center" colspan="8">No hay datos que mostrar</td>
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
