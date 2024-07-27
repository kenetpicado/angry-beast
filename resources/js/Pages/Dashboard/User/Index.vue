<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import { computed, ref } from 'vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import { useForm } from '@inertiajs/vue3'
import { created, deleted, updated } from '@/Utils/toast.js'
import { IconEdit, IconLock, IconTrash } from '@tabler/icons-vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import ActionIcon from '@/Components/ActionIcon.vue'

defineProps({
  users: {
    type: Object,
    required: true
  }
})

const openModal = ref(false)

const form = useForm({
  id: null,
  name: '',
  email: ''
})

function onSubmit() {
  if (form.id) {
    form.put(route('dashboard.users.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        updated()
        resetValues()
      }
    })
  } else {
    form.post(route('dashboard.users.store'), {
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
  form.email = client.email
  openModal.value = true
}

function destroy(id) {
  confirm('¿Estas seguro de eliminar este usuario?') &&
    form.delete(route('dashboard.users.destroy', id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        deleted()
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
      <h2 class="text-2xl font-semibold">Usuarios</h2>

      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>

    <TableSection>
      <template #header>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Tipo</th>
        <th>Compañia</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="users.data.length == 0">
          <td class="text-center text-slate-400" colspan="4">No hay datos que mostrar</td>
        </tr>
        <tr v-for="user in users.data" :key="user.id">
          <td>
            <div>{{ user.name }}</div>
            <small class="text-primary tracking-wider">Activo: {{ user.active }}</small>
          </td>
          <td>
            {{ user.email }}
          </td>
          <td>
            {{ user.type }}
          </td>
          <td>
            {{ user.company }}
          </td>
          <td>
            <div class="flex gap-3">
              <ActionIcon :icon="IconEdit" @click="edit(user)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(user.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="users.links" />
      </template>
    </TableSection>

    <Modal v-model="openModal" class="z-30">
      <form
        class="bg-white rounded-md px-7 py-5 w-full flex flex-col"
        style="max-width: 50rem; min-height: 20rem"
        @submit.prevent="onSubmit"
      >
        <h2 class="text-xl font-semibold mb-5">Usuario</h2>
        <div class="flex-1">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <InputForm v-model="form.name" label="Nombre" name="name" required />
            <InputForm v-model="form.email" label="Correo" name="email" type="email" />
          </div>
        </div>
        <div class="flex gap-3 items-center justify-end">
          <SecondaryButton text="Cancelar" @click="resetValues" />
          <PrimaryButton text="Guardar" type="submit" :loading="form.processing" />
        </div>
      </form>
    </Modal>
  </DefaultLayout>
</template>
