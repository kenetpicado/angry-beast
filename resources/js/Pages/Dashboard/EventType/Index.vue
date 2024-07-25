<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { created, deleted, updated, error } from '@/Utils/toast.js'
import { useForm } from '@inertiajs/vue3'
import { IconEdit, IconTrash, IconEye } from '@tabler/icons-vue'
import { ref } from 'vue'
import confirmAction from '@/Utils/confirmation'
import ActionIcon from '@/Components/ActionIcon.vue'

defineProps(['event_types'])

const openModal = ref(false)

const form = useForm({
  id: null,
  name: ''
})

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.event-types.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.event-types.store'), {
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
      form.delete(route('dashboard.event-types.destroy', id), {
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
  <DefaultLayout head="Tipos de eventos">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Tipos de eventos</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="event_types.data.length == 0">
          <td class="text-center" colspan="3">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in event_types.data" :key="item.id">
          <td>
            {{ index + 1 + (event_types.current_page - 1) * event_types.per_page }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.event-types.show', item.id)"
                tooltip="Detalles"
              />
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="event_types.links" />
      </template>
    </TableSection>

    <ModalForm
      v-model="openModal"
      @onSubmit="onSubmit"
      @onCancel="resetValues"
      title="Tipo de evento"
    >
      <InputForm v-model="form.name" label="Nombre" name="name" required class="col-span-2" />
    </ModalForm>
  </DefaultLayout>
</template>
