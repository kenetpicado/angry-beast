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
  categories: {
    type: Object,
    required: true
  }
})

const openModal = ref(false)

const form = useForm({
  id: null,
  name: ''
})

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.categories.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.categories.store'), {
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
      form.delete(route('dashboard.categories.destroy', id), {
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
      <h2 class="text-2xl font-semibold">Grupos</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="categories.data.length == 0">
          <td class="text-center text-slate-400" colspan="3">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in categories.data" :key="item.id">
          <td>
            {{ index + 1 + (categories.current_page - 1) * categories.per_page }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.categories.show', item.id)"
                tooltip="Detalles"
              />
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="categories.links" />
      </template>
    </TableSection>

    <ModalForm v-model="openModal" @onSubmit="onSubmit" @onCancel="resetValues" title="Grupo">
      <InputForm class="col-span-2" v-model="form.name" label="Nombre" name="name" required />
    </ModalForm>
  </DefaultLayout>
</template>
