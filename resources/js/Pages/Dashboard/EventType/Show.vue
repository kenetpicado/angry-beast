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
import useEvent from '@/Composables/useEvent.js'

const props = defineProps(['events', 'event_type'])

const openModal = ref(false)
const addReminder = ref(false)
const tab = ref('EVENTS')

const { storeEvent, updateEvent, formEvent, setEventValues } = useEvent({
  model_id: props.event_type.id,
  model_type: 'App\\Models\\EventType'
})

function edit(item) {
  setEventValues(item)
  openModal.value = true
}

const tabs = [
  {
    label: 'Eventos',
    value: 'EVENTS',
    icon: IconUserDollar
  }
]

function onSubmit() {
  if (formEvent.id) {
    updateEvent(() => ((openModal.value = false), (addReminder.value = false)))
  } else {
    storeEvent(() => ((openModal.value = false), (addReminder.value = false)))
  }
}

function onCancel() {
  formEvent.reset()
  openModal.value = false
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
        <th>Nombre</th>
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
            {{ item.name }}
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
      @onCancel="onCancel"
      title="Evento"
      :loading="formEvent.processing"
    >
      <InputForm v-model="formEvent.name" label="Nombre" required name="name" />
      <InputForm
        v-model="formEvent.quantity"
        label="Cantidad"
        name="quantity"
        type="number"
        required
      />
      <label class="inline-flex items-center cursor-pointer lg:col-span-2 mb-4">
        <span class="mr-3 text-sm">Agregar recordatorio</span>
        <input type="checkbox" v-model="addReminder" class="sr-only peer" />
        <div
          class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"
        ></div>
      </label>
      <template v-if="addReminder">
        <InputForm
          v-model="formEvent.reminder.name"
          label="Nombre del recordatorio"
          name="reminder.name"
          required
        />
        <InputForm
          v-model="formEvent.reminder.date"
          label="Fecha del recordatorio"
          name="reminder.date"
          type="date"
          required
        />
      </template>
    </ModalForm>
  </DefaultLayout>
</template>
