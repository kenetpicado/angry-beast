<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconEdit, IconTrash } from '@tabler/icons-vue'
import { onMounted, ref } from 'vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date'
import useExpenditure from '@/Composables/useExpenditure'

const props = defineProps({
  employee: {
    type: Object,
    required: true
  },
  payments: {
    type: Object,
    required: true
  }
})

const openModal = ref(false)

const { store, update, destroy, form } = useExpenditure({
  model_id: props.employee.id,
  model_type: 'App\\Models\\Employee'
})

function onSubmit() {
  if (form.value <= 0) {
    error('El monto debe ser mayor a 0')
    return
  }

  if (form.id) update(resetValues)
  else store(resetValues)
}

function edit(item) {
  form.id = item.id
  form.description = item.description
  form.value = item.value
  openModal.value = true
}

function resetValues() {
  openModal.value = false
  form.reset()
}

onMounted(() => {
  form.model_id = props.employee.id
  form.model_type = 'App\\Models\\Employee'
})
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Pagos: {{ employee.name }}</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

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
          <td class="font-bold">C${{ item.value }}</td>
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

    <ModalForm v-model="openModal" @onSubmit="onSubmit" @onCancel="resetValues" title="Pago">
      <InputForm v-model="form.description" label="Descripcion" required name="description" />
      <InputForm v-model="form.value" label="Monto" name="value" type="number" required />
    </ModalForm>
  </DefaultLayout>
</template>
