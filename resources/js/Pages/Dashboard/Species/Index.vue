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
  species: {
    type: Object,
    required: true
  }
})

const openModal = ref(false)

const form = useForm({
  id: null,
  name: '',
  description: ''
})

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.species.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.species.store'), {
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
  form.name = item.name
  form.description = item.description
  openModal.value = true
}

function destroy(id) {
  confirmAction({
    callback: () => {
      form.delete(route('dashboard.species.destroy', id), {
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
      <h2 class="text-2xl font-semibold">Especies</h2>
      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="species.data.length == 0">
          <td class="text-center text-slate-400" colspan="3">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in species.data" :key="item.id">
          <td>
            {{ index + 1 + (species.current_page - 1) * species.per_page }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            {{ item.animals_count }}
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
        <Pagination :links="species.links" />
      </template>
    </TableSection>

    <ModalForm
      :loading="form.processing"
      v-model="openModal"
      @onSubmit="onSubmit"
      @onCancel="resetValues"
      title="Especie"
    >
      <InputForm class="col-span-2" v-model="form.name" label="Nombre" name="name" required />
      <InputForm
        class="col-span-2"
        v-model="form.description"
        label="Descripcion (Opcional)"
        name="description"
      />
    </ModalForm>
  </DefaultLayout>
</template>
