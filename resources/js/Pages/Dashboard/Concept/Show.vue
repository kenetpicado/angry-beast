<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconEdit, IconTrash, IconUserDollar } from '@tabler/icons-vue'
import { ref } from 'vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date'
import useTransaction from '@/Composables/useTransaction'
import Tabs from '@/Components/Tabs.vue'
import transaction_type from '@/Utils/types'
import SelectForm from '@/Components/Form/SelectForm.vue'

const props = defineProps(['concept', 'transactions'])

const openModal = ref(false)
const tab = ref('transacciones')

const { destroy, form, onSubmit, setValues } = useTransaction({
  model_id: props.concept.id,
  model_type: 'App\\Models\\Concept'
})

function edit(item) {
  setValues(item)
  openModal.value = true
}

function resetValues() {
  openModal.value = false
  form.reset()
}

const tabs = [
  {
    label: 'Transacciones',
    value: 'transacciones',
    icon: IconUserDollar
  }
]
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-4 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">{{ concept.name }}</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <Tabs :options="tabs" v-model="tab" />

    <TableSection>
      <template #header>
        <th>Fecha</th>
        <th>Tipo</th>
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
            <span :class="[item.type === 'INGRESO' ? 'badge-primary' : 'badge-red']">
              {{ item.type }}
            </span>
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
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="transactions.links" />
      </template>
    </TableSection>

    <ModalForm
      v-model="openModal"
      @onSubmit="onSubmit(() => (openModal = false))"
      @onCancel="resetValues"
      title="Transaccion"
    >
      <SelectForm v-model="form.type" label="Tipo" name="type" required>
        <option value="" selected>Seleccione un tipo</option>
        <option v-for="item in transaction_type" :key="item" :value="item">
          {{ item }}
        </option>
      </SelectForm>
      <InputForm v-model="form.description" label="Descripcion" required name="description" />
      <InputForm v-model="form.quantity" label="Cantidad" name="quantity" type="number" required />
      <InputForm v-model="form.value" label="Monto" name="value" type="number" required />
      <div class="col-span-2 font-bold text-lg">
        Total C${{ (form.quantity * form.value).toLocaleString() }}
      </div>
    </ModalForm>
  </DefaultLayout>
</template>
