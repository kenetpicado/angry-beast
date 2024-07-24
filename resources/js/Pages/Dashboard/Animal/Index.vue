<script setup>
import ActionIcon from '@/Components/ActionIcon.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import confirmAction from '@/Utils/confirmation'
import { deleted } from '@/Utils/toast.js'
import { router } from '@inertiajs/vue3'
import { IconEdit, IconEye, IconTrash } from '@tabler/icons-vue'

defineProps({
  animals: {
    type: Object,
    required: true
  }
})

function destroy(id) {
  confirmAction({
    callback: () => {
      router.delete(route('dashboard.animals.destroy', id), {
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
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Animales</h2>
      <PrimaryButton text="Nuevo" @click="$inertia.visit(route('dashboard.animals.create'))" />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="animals.data.length == 0">
          <td class="text-center" colspan="4">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in animals.data" :key="item.id">
          <td>
            {{ index + 1 + (animals.current_page - 1) * animals.per_page }}
          </td>
          <td>
              {{ item.code }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.animals.show', item.id)"
                tooltip="Detalles"
              />
              <ActionIcon :icon="IconEdit" @click="edit(item)" tooltip="Editar" />
              <ActionIcon :icon="IconTrash" @click="destroy(item.id)" tooltip="Eliminar" />
            </div>
          </td>
        </tr>
      </template>

      <template #footer>
        <Pagination :links="animals.links" />
      </template>
    </TableSection>
  </DefaultLayout>
</template>
