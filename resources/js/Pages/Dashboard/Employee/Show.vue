<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { created, deleted, updated, error } from '@/Utils/toast.js'
import { useForm } from '@inertiajs/vue3'
import { IconEdit, IconTrash } from '@tabler/icons-vue'
import { ref } from 'vue'
import confirmAction from '@/Utils/confirmation'
import ActionIcon from '@/Components/ActionIcon.vue'
import { useDateFormat } from '@vueuse/core'

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

const form = useForm({
  id: null,
  model_id: props.employee.id,
  model_type: 'App\\Models\\Employee',
  concept: 'Salario',
  description: '',
  value: null
})

function onSubmit() {
  if (!form.concept) {
    error('El concepto es requerido')
    return
  }

  if (form.value <= 0) {
    error('El monto debe ser mayor a 0')
    return
  }

  if (form.id) {
    form.put(route('dashboard.expenditures.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.expenditures.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        resetValues()
      }
    })
  }
}

function edit(item) {
  form.id = item.id
  form.concept = item.concept
  form.description = item.description
  form.value = item.value
  openModal.value = true
}

function destroy(id) {
  confirmAction({
    callback: () => {
      form.delete(route('dashboard.expenditures.destroy', id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          deleted()
        }
      })
    }
  })
}

function resetValues() {
  openModal.value = false
  form.reset()
}

const getFormattedDate = (date) => {
  return useDateFormat(date, "DD/MM/YY h:mm A").value
}

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
        <th>Concepto</th>
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
            {{ item.concept }}
          </td>
          <td>
            {{ item.description }}
          </td>
          <td class="font-bold">
            C${{ item.value }}
          </td>
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
      <InputForm v-model="form.concept" label="Concepto" name="concept" required />
      <InputForm v-model="form.description" label="Descripcion (Opcional)" name="description"/>
      <InputForm v-model="form.value" label="Monto" name="value" type="number" required />
    </ModalForm>
  </DefaultLayout>
</template>
