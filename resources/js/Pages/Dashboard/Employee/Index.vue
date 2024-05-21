<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import Pagination from '@/Components/Pagination.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { created, deleted, updated } from '@/Utils/toast.js'
import { useForm } from '@inertiajs/vue3'
import { IconEdit, IconEye, IconTrash } from '@tabler/icons-vue'
import { ref } from 'vue'

defineProps({
  employees: {
    type: Object,
    required: true
  }
})

const openModal = ref(false)

const form = useForm({
  id: null,
  name: '',
  phone: '',
  schedule: '',
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
  confirm('¿Estas seguro de eliminar este usuario?') &&
    form.delete(route('dashboard.employees.destroy', id), {
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
      <h2 class="text-xl font-semibold">Personal</h2>

      <PrimaryButton text="Nuevo" @click="openModal = true" />
    </div>
    <div class="bg-white p-0 lg:p-4 rounded-sm flex flex-col">
      <div class="max-w-full overflow-x-auto">
        <table class="w-full table-auto text-left text-sm lg:text-base">
          <thead class="uppercase text-xs tracking-widest">
            <tr>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Horario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="employees.data.length == 0">
              <td class="text-center text-slate-400" colspan="4">No hay datos que mostrar</td>
            </tr>
            <tr v-for="item in employees.data" :key="item.id">
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
                <div class="flex gap-3">
                  <IconEye role="button" size="25" stroke="2" @click="$inertia.visit(route('dashboard.employees.show', item.id))" />
                  <IconEdit role="button" size="25" stroke="2" @click="edit(item)" />
                  <IconTrash role="button" size="25" stroke="2" @click="destroy(item.id)" />
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="employees.links" />
    </div>

    <Modal v-model="openModal" class="z-30">
      <form class="bg-white rounded-xl px-7 py-5 w-full flex flex-col" style="max-width: 50rem; min-height: 20rem"
        @submit.prevent="onSubmit">
        <h2 class="text-xl font-semibold mb-5">Personal</h2>
        <div class="flex-1">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <InputForm v-model="form.name" label="Nombre" name="name" required />
            <InputForm v-model="form.phone" label="Telefono" name="phone" type="number" />

            <InputForm v-model="form.schedule" label="Horario" name="horario" />
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
