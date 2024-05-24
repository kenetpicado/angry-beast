<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { created, deleted, updated } from '@/Utils/toast.js'
import { useForm } from '@inertiajs/vue3'
import { IconEdit, IconEye, IconTrash } from '@tabler/icons-vue'
import { ref } from 'vue'
import confirmAction from '@/Utils/confirmation'
import ActionIcon from '@/Components/ActionIcon.vue'

defineProps({
  employees: {
    type: Object,
    required: true
  },
})

const openModal = ref(false)

const form = useForm({
  id: null,
  name: '',
  phone: '',
  schedule: ''
})

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.employees.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.employees.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        resetValues()
      }
    })
  }
}

function edit(client) {
  form.id = client.id
  form.name = client.name
  form.phone = client.phone
  form.schedule = client.schedule
  openModal.value = true
}

function destroy(id) {
  confirmAction({
    callback: () => {
      form.delete(route('dashboard.employees.destroy', id), {
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
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Personal</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Horario</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="employees.data.length == 0">
          <td class="text-center text-slate-400" colspan="5">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in employees.data" :key="item.id">
          <td>
            {{ index + 1 + (employees.current_page - 1) * employees.per_page }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            {{ item.phone }}
          </td>
          <td>
            {{ item.schedule }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.employees.show', item.id)"
                tooltip="Detalles"
              />
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="employees.links" />
      </template>
    </TableSection>

    <ModalForm v-model="openModal" @onSubmit="onSubmit" @onCancel="resetValues" title="Personal">
      <InputForm v-model="form.name" label="Nombre" name="name" required />
      <InputForm v-model="form.phone" label="Telefono" name="phone" type="number" />
      <InputForm v-model="form.schedule" label="Horario" name="horario" />
    </ModalForm>
  </DefaultLayout>
</template>
