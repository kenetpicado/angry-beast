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
import Tabs from '@/Components/Tabs.vue'
import { useForm } from '@inertiajs/vue3'
import { created, deleted, updated } from '@/Utils/toast.js'
import { router } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'

const props = defineProps(['events', 'event_type'])

const openModal = ref(false)
const tab = ref('EVENTS')

const form = useForm({
  id: null,
  model_id: props.event_type.id,
  model_type: 'App\\Models\\EventType',
  description: '',
  quantity: 0
})

function edit(item) {
  form.id = item.id
  form.description = item.description
  form.quantity = item.quantity
  openModal.value = true
}

function resetValues() {
  openModal.value = false
  form.reset()
}

const tabs = [
  {
    label: 'Eventos',
    value: 'EVENTS',
    icon: IconUserDollar
  }
]

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.events.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.events.store'), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        created()
        resetValues()
      }
    })
  }
}

function destroy(id) {
  confirmAction({
    callback: () => {
      router.delete(route('dashboard.events.destroy', id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          deleted()
        }
      })
    }
  })
}
</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-4 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">{{ event_type.name }}</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <Tabs :options="tabs" v-model="tab" />

    <TableSection>
      <template #header>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="events.data.length == 0">
          <td class="text-center text-slate-400" colspan="6">No hay datos que mostrar</td>
        </tr>
        <tr v-for="item in events.data" :key="item.id">
          <td>
            {{ getFormattedDate(item.created_at) }}
          </td>
          <td>
            {{ item.description }}
          </td>
          <td>
            {{ item.quantity }}
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
        <Pagination :links="events.links" />
      </template>
    </TableSection>

    <ModalForm
      v-model="openModal"
      @onSubmit="onSubmit()"
      @onCancel="resetValues"
      title="Evento"
      :loading="form.processing"
    >
      <InputForm v-model="form.description" label="Descripción" required name="description" />
      <InputForm v-model="form.quantity" label="Cantidad" name="quantity" type="number" required />
    </ModalForm>
  </DefaultLayout>
</template>
