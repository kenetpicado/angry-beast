<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { created, deleted, error, updated } from '@/Utils/toast.js'
import { useForm } from '@inertiajs/vue3'
import { IconEdit, IconTrash, IconEye } from '@tabler/icons-vue'
import { ref } from 'vue'
import confirmAction from '@/Utils/confirmation'
import ActionIcon from '@/Components/ActionIcon.vue'
import getFormattedDate from '@/Utils/date.js'

defineProps(['concepts'])

const openModal = ref(false)

const form = useForm({
  id: null,
  name: ''
})

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.concepts.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.concepts.store'), {
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
  openModal.value = true
}

function destroy(id) {
  confirmAction({
    callback: () => {
      form.delete(route('dashboard.concepts.destroy', id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          deleted()
        },
        onError: (err) => {
          error(err.message)
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
  <DefaultLayout head="Conceptos">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Conceptos</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>último egreso</th>
        <th>último ingreso</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="concepts.data.length == 0">
          <td class="text-center" colspan="3">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in concepts.data" :key="item.id">
          <td>
            {{ index + 1 + (concepts.current_page - 1) * concepts.per_page }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            <span v-if="item.last_egreso" class="badge-red">
              {{ getFormattedDate(item.last_egreso) }}
            </span>
            <span v-else> No registrado </span>
          </td>
          <td>
            <span v-if="item.last_ingreso" class="badge-primary">
              {{ getFormattedDate(item.last_ingreso) }}
            </span>
            <span v-else> No registrado </span>
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.concepts.show', item.id)"
                tooltip="Detalles"
              />
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="concepts.links" />
      </template>
    </TableSection>

    <ModalForm v-model="openModal" @onSubmit="onSubmit" @onCancel="resetValues" title="Concepto">
      <InputForm v-model="form.name" label="Nombre" name="name" required class="col-span-2" />
    </ModalForm>
  </DefaultLayout>
</template>
