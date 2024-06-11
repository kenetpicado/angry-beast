<script setup>
import ActionIcon from '@/Components/ActionIcon.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import confirmAction from '@/Utils/confirmation'
import { deleted } from '@/Utils/toast.js'
import { router } from '@inertiajs/vue3'
import { IconEye, IconTrash } from '@tabler/icons-vue'
import SelectForm from '@/Components/Form/SelectForm.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import { reactive } from 'vue'
import { watchDebounced } from '@vueuse/core'

defineProps(['animals', 'species'])

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

const queryParams = reactive({
  specie_id: '',
  search: ''
})

watchDebounced(
  queryParams,
  () => {
    let params = { ...queryParams }

    for (const key in params) {
      if (!params[key]) delete params[key]
    }

    router.get(route('dashboard.animals.index'), params, {
      preserveState: true,
      preserveScroll: true,
      only: ['animals'],
      replace: true
    })
  },
  { debounce: 500, maxWait: 1000 }
)

</script>

<template>
  <DefaultLayout head="Usuarios">
    <div class="mb-6 flex gap-3 items-center justify-between">
      <h2 class="text-2xl font-semibold">Animales</h2>
      <PrimaryButton text="Nuevo" @click="$inertia.visit(route('dashboard.animals.create'))" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mb-3">
      <SelectForm v-model="queryParams.specie_id" label="Especie">
        <option value="" selected>Todos</option>
        <option v-for="item in species" :key="item" :value="item.id">
          {{ item.name }}
        </option>
      </SelectForm>
      <InputForm
        v-model="queryParams.search"
        label="Buscar"
        type="search"
        placeholder="Buscar"
      />
    </div>

    <TableSection>
      <template #header>
        <th>#</th>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Especie</th>
        <th>Acciones</th>
      </template>

      <template #body>
        <tr v-if="animals.data.length == 0">
          <td class="text-center" colspan="5">No hay datos que mostrar</td>
        </tr>
        <tr v-for="(item, index) in animals.data" :key="item.id">
          <td>
            {{ index + 1 + (animals.current_page - 1) * animals.per_page }}
          </td>
          <td>
            {{ item.name }}
          </td>
          <td>
            {{ item.code }}
          </td>
          <td>
            {{ item.specie?.name || 'Ninguna' }}
          </td>
          <td>
            <div class="flex gap-4">
              <ActionIcon
                :icon="IconEye"
                :href="route('dashboard.animals.show', item.id)"
                tooltip="Detalles"
              />
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
