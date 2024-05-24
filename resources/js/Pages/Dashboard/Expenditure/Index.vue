<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { IconEdit, IconEye, IconTrash } from '@tabler/icons-vue'
import { ref } from 'vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date'
import useExpenditure from '@/Composables/useExpenditure'
import SelectForm from '@/Components/Form/SelectForm.vue'

defineProps({
  expenditures: {
    type: Object,
    required: true
  },
  concepts: {
    type: Object,
    required: true
  }
})

const openModal = ref(false)

const { store, update, destroy, form } = useExpenditure({
  model_type: 'App\\Models\\Concept'
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
  form.model_id = item.model_id
  form.model_type = item.model_type
  form.description = item.description
  form.quantity = item.quantity
  form.value = item.value
  openModal.value = true
}

function resetValues() {
  openModal.value = false
  form.reset()
}
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Egresos</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>Fecha</th>
        <th>Concepto</th>
        <th>Descripcion</th>
        <th>Cantidad</th>
        <th>Monto</th>
        <th>Total</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="expenditures.data.length == 0">
          <td class="text-center text-slate-400" colspan="3">No hay datos que mostrar</td>
        </tr>
        <tr v-for="item in expenditures.data" :key="item.id">
          <td>
            {{ getFormattedDate(item.created_at) }}
          </td>
          <td>
            {{ item.model_type.split('\\').pop() }}
          </td>
          <td>
            {{ item.description }}
          </td>
          <td>
            {{ item.quantity }}
          </td>
          <td>C${{ item.value }}</td>
          <td class="font-bold">C${{ item.quantity * item.value }}</td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.expenditures.show', item.id)"
                tooltip="Detalles"
              />
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="expenditures.links" />
      </template>
    </TableSection>

    <ModalForm v-model="openModal" @onSubmit="onSubmit" @onCancel="resetValues" title="Egreso">
      <SelectForm
        v-if="form.model_type == 'App\\Models\\Concept'"
        v-model="form.model_id"
        label="Concepto"
        name="model_type"
        required
      >
        <option value="" selected>Seleccione un concepto</option>
        <option v-for="concept in concepts" :key="concept.id" :value="concept.id">
          {{ concept.name }}
        </option>
      </SelectForm>
      <InputForm v-model="form.description" label="Descripcion" name="description" required />
      <InputForm v-model="form.quantity" label="Cantidad" name="quantity" type="number" required />
      <InputForm v-model="form.value" label="Monto" name="value" type="number" required />
      <div class="col-span-2 font-bold text-lg">
        Total C${{ (form.quantity * form.value).toLocaleString() }}
      </div>
    </ModalForm>
  </DefaultLayout>
</template>
