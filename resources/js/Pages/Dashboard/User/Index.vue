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
  email: '',
  password: '',
  password_confirmation: ''
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

const passwordStatus = computed(() => {
  if (form.password.length < 8) {
    return 'La contraseña debe contener al menos 8 caracteres'
  }

  if (!/\d/.test(form.password)) {
    return 'La contraseña debe contener al menos un número'
  }

  if (!/[A-Z]/.test(form.password)) {
    return 'La contraseña debe contener al menos una letra mayúscula'
  }

  if (!/[a-z]/.test(form.password)) {
    return 'La contraseña debe contener al menos una letra minúscula'
  }

  if (form.password !== form.password_confirmation) {
    return 'La confirmación de contraseña debe coincidir'
  }

  return null
})
</script>

<template>
  <DefaultLayout>
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-xl font-semibold">Usuarios</h2>

      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>
    <div class="bg-white p-0 lg:p-4 rounded-xl flex flex-col">
      <div class="max-w-full overflow-x-auto">
        <table class="w-full table-auto text-left text-sm lg:text-base">
          <thead class="uppercase text-xs tracking-widest">
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="users.data.length == 0">
              <td class="text-center text-slate-400" colspan="4">No hay datos que mostrar</td>
            </tr>
            <tr v-for="user in users.data" :key="user.id">
              <td>
                <div>{{ user.name }}</div>
                <small class="text-green-700 tracking-wider">Activo: {{ user.active }}</small>
              </td>
              <td>
                {{ user.email }}
              </td>
              <td>
                <div class="flex gap-3">
                  <IconEdit role="button" size="25" stroke="2" @click="edit(user)" />
                  <IconTrash role="button" size="25" stroke="2" @click="destroy(user.id)" />
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="users.links" />
    </div>

    <Modal v-model="openModal" class="z-30">
      <form
        class="bg-white rounded-xl px-7 py-5 w-full flex flex-col"
        style="max-width: 50rem; min-height: 20rem"
        @submit.prevent="onSubmit"
      >
        <h2 class="text-xl font-semibold mb-5">Usuario</h2>
        <div class="flex-1">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <InputForm v-model="form.name" label="Nombre" name="name" required />
            <InputForm v-model="form.email" label="Correo" name="email" type="email" />

            <InputForm
              v-model="form.password"
              label="Contraseña"
              name="password"
              required
              type="password"
            >
              <IconLock class="text-stroke" size="25" stroke="2" />
            </InputForm>

            <InputForm
              v-model="form.password_confirmation"
              label="Confirmar contraseña"
              name="password_confirmation"
              required
              type="password"
            >
              <IconLock class="text-stroke" size="25" stroke="2" />
            </InputForm>
            <div
              v-if="passwordStatus && form.password"
              class="mb-2 text-red-400 text-sm col-span-2"
            >
              {{ passwordStatus }}
            </div>
          </div>
        </div>
        <div class="flex gap-3 items-center justify-end">
          <SecondaryButton text="Cancelar" @click="resetValues" />
          <PrimaryButton text="Guardar" type="submit" />
        </div>
      </form>
    </Modal>
  </DefaultLayout>
</template>
