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

const props = defineProps(['employee', 'payments'])

const openModal = ref(false)
const tab = ref('pagos')

const { destroy, form, onSubmit, setValues } = useTransaction({
  model_id: props.employee.id,
  model_type: 'App\\Models\\Employee',
  type: transaction_type.EGRESO
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
    label: 'Pagos',
    value: 'pagos',
    icon: IconUserDollar
  }
]
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-4 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">{{ employee.name }}</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <Tabs :options="tabs" v-model="tab" />

    <TableSection>
      <template #header>
        <th>Fecha</th>
        <th>Descripcion</th>
        <th>Total</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="payments.data.length == 0">
          <td class="text-center text-slate-400" colspan="6">No hay datos que mostrar</td>
        </tr>
        <tr v-for="item in payments.data" :key="item.id">
          <td>
            {{ getFormattedDate(item.created_at) }}
          </td>
          <td>
            {{ item.description }}
          </td>
          <td class="font-bold">C${{ item.value.toLocaleString() }}</td>
          <td>
            <div class="flex gap-4">
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="payments.links" />
      </template>
    </TableSection>

    <ModalForm
      v-model="openModal"
      @onSubmit="onSubmit(() => (openModal = false))"
      @onCancel="resetValues"
      title="Pago"
    >
      <InputForm v-model="form.description" label="Descripcion" required name="description" />
      <InputForm v-model="form.value" label="Monto" name="value" type="number" required />
    </ModalForm>
  </DefaultLayout>
</template>
