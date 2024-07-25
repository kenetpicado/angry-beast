<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { defineProps, ref } from 'vue'
import InputForm from '@/Components/Form/InputForm.vue'
import ModalForm from '@/Components/ModalForm.vue'
import SelectForm from '@/Components/Form/SelectForm.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import getFormattedDate, { getBasicDate } from '@/Utils/date.js'
import Tabs from '@/Components/Tabs.vue'
import { IconEye, IconVaccine, IconUpload, IconTrash, IconEdit } from '@tabler/icons-vue'
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import confirmAction from '@/Utils/confirmation'
import { deleted, updated } from '@/Utils/toast.js'
import Pagination from '@/Components/Pagination.vue'
import TableSection from '@/Components/TableSection.vue'
import ActionIcon from '@/Components/ActionIcon.vue'
import useEvent from '@/Composables/useEvent.js'

const edit = ref(false)
const tab = ref('detalles')

const props = defineProps(['animal', 'details', 'species', 'events'])

const preview = ref(props.animal?.photo)
const isUploadingPhoto = ref(false)
const openModal = ref(false)

const { storeEvent, updateEvent, formEvent, setEventValues, destroyEvent } = useEvent({
  model_id: props.animal.id,
  model_type: 'App\\Models\\Animal'
})

const form = useForm({
  id: props.animal.id,
  name: props.animal.name,
  code: props.animal.code,
  specie_id: props.animal.specie_id,
  photo: props.animal.photo,
  details: {
    gender: props.details.gender || 'Hembra',
    race: props.details.race || '',
    initial_weight: props.details.initial_weight || '',
    initial_height: props.details.initial_height || '',
    birth_date: props.details.birth_date || '',
    adoption_date: props.details.adoption_date || '',
    entry_date: props.details.entry_date || '',
    exit_date: props.details.exit_date || '',
    death_date: props.details.death_date || '',
    cause_of_death: props.details.cause_of_death || ''
  }
})

function cancelUpdatePhoto() {
  preview.value = ''
  form.details.photo = ''
}

const tabs = [
  {
    label: 'Detalles',
    value: 'detalles',
    icon: IconEye
  },
  {
    label: 'Eventos',
    value: 'eventos',
    icon: IconVaccine
  }
]

function afterUpdate() {
  router.reload({ only: ['animal'] })
  edit.value = false
}

function handlePhotoChange(event) {
  form.photo = event.target.files[0]
  const reader = new FileReader()
  reader.readAsDataURL(form.photo)
  reader.onload = () => {
    preview.value = reader.result
  }
}

function confirmRemoveImage() {
  confirmAction({
    callback: () => {
      router.delete(route('dashboard.photo.destroy', form.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          form.photo = ''
          preview.value = ''
          deleted()
        }
      })
    }
  })
}

function update() {
  if (form.code.includes(' ')) {
    error('El codigo no debe contener espacios en blanco')
    return
  }

  form
    .transform((data) => ({
      ...data,
      photo: null
    }))
    .put(route('dashboard.animals.update', form.id), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        afterUpdate()
        updated()
      },
      onError: (err) => {
        console.log(err)
      }
    })
}

function updatePhoto() {
  isUploadingPhoto.value = true
  router.post(
    route('dashboard.photo.store'),
    {
      photo: form.photo,
      animal_id: form.id
    },
    {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        form.photo = ''
        updated()
      },
      onFinish: () => {
        isUploadingPhoto.value = false
      }
    }
  )
}

function editEvent(item) {
  setEventValues(item)
  openModal.value = true
}

function onSubmit() {
  if (formEvent.id) {
    updateEvent(() => (openModal.value = false))
  } else {
    storeEvent(() => (openModal.value = false))
  }
}

function onCancel() {
  formEvent.reset()
}
</script>

<template>
  <DefaultLayout head="Detalles">
    <div class="mx-auto max-w-270">
      <div class="mb-4 flex gap-3 items-center justify-between h-12">
        <h2 class="text-2xl font-semibold">{{ animal.code }}</h2>
        <PrimaryButton v-if="tab == 'eventos'" text="Nuevo" @click="openModal = true" />
      </div>

      <Tabs :options="tabs" v-model="tab" />

      <div v-if="tab == 'detalles'" class="grid grid-cols-5 gap-8">
        <div class="col-span-5 lg:col-span-3">
          <div class="rounded-md border border-stroke bg-white shadow-default">
            <div class="border-b border-stroke py-4 px-7">
              <h3 class="font-medium">Datos generales</h3>
            </div>
            <div class="p-7">
              <form @submit.prevent="update()">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <template v-if="!edit">
                    <div>
                      <label class="text-base font-bold">Código</label>
                      <p class="text-base">{{ animal.code }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Nombre</label>
                      <p class="text-base">{{ animal.name }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Especie</label>
                      <p class="text-base">{{ animal.specie?.name ?? 'Ninguna' }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Género</label>
                      <p class="text-base">{{ details.gender }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Raza</label>
                      <p class="text-base">{{ details.race }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Peso inicial</label>
                      <p class="text-base">{{ details.initial_weight }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Altura inicial</label>
                      <p class="text-base">{{ details.initial_height }}</p>
                    </div>
                    <div v-if="details.birth_date">
                      <label class="text-base font-bold">Fecha de nacimiento</label>
                      <p class="text-base">{{ getBasicDate(details.birth_date) }}</p>
                    </div>
                    <div v-if="details.adoption_date">
                      <label class="text-base font-bold">Fecha de adopción</label>
                      <p class="text-base">{{ getBasicDate(details.adoption_date) }}</p>
                    </div>
                    <div v-if="details.entry_date">
                      <label class="text-base font-bold">Fecha de ingreso</label>
                      <p class="text-base">{{ getBasicDate(details.entry_date) }}</p>
                    </div>
                    <div v-if="details.exit_date">
                      <label class="text-base font-bold">Fecha de salida</label>
                      <p class="text-base">
                        {{ getBasicDate(details.exit_date) }}
                      </p>
                    </div>
                    <div v-if="details.death_date">
                      <label class="text-base font-bold">Fecha de muerte</label>
                      <p class="text-base">
                        {{ getBasicDate(details.death_date) }}
                      </p>
                    </div>
                    <div v-if="details.cause_of_death">
                      <label class="text-base font-bold">Causa de muerte</label>
                      <p class="text-base">
                        {{ details.cause_of_death }}
                      </p>
                    </div>
                  </template>
                  <template v-else>
                    <InputForm v-model="form.code" label="Código" name="code" required />
                    <InputForm v-model="form.name" label="Nombre" name="name" />
                    <SelectForm v-model="form.specie_id" label="Especie" name="specie_id">
                      <option value="">Ninguna</option>
                      <option v-for="specie in species" :value="specie.id">
                        {{ specie.name }}
                      </option>
                    </SelectForm>
                    <SelectForm v-model="form.details.gender" label="Genero" name="gender">
                      <option value="Macho">Macho</option>
                      <option value="Hembra">Hembra</option>
                    </SelectForm>
                    <InputForm v-model="form.details.race" label="Raza" name="race" />
                    <InputForm
                      v-model="form.details.initial_weight"
                      label="Peso Inicial"
                      name="initial_weight"
                      type="number"
                    />
                    <InputForm
                      v-model="form.details.initial_height"
                      label="Altura Inicial"
                      name="initial_height"
                      type="number"
                    />
                    <InputForm
                      v-model="form.details.birth_date"
                      label="Fecha de nacimiento"
                      name="birth_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.details.adoption_date"
                      label="Fecha de adopción"
                      name="adoption_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.details.entry_date"
                      label="Fecha de ingreso"
                      name="entry_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.details.exit_date"
                      label="Fecha de salida"
                      name="exit_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.details.death_date"
                      label="Fecha de muerte"
                      name="death_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.details.cause_of_death"
                      label="Causa de muerte"
                      name="cause_of_death"
                    />
                    <div class="flex gap-4 items-center justify-end col-span-2">
                      <SecondaryButton text="Cancelar" @click="edit = false" />
                      <PrimaryButton :loading="form.processing" text="Guardar" type="submit" />
                    </div>
                  </template>
                </div>
              </form>
              <button v-if="!edit" type="button" class="text-primary mt-4" @click="edit = true">
                Editar
              </button>
            </div>
          </div>
        </div>

        <div class="col-span-5 lg:col-span-2">
          <div class="rounded-md border border-stroke bg-white shadow-default">
            <div class="border-b border-stroke py-4 px-7">
              <h3 class="font-medium">Foto</h3>
            </div>
            <div class="p-7">
              <div v-if="preview" class="mb-4 w-full flex justify-center">
                <img
                  :src="preview"
                  alt=""
                  class="mb-2 w-auto max-h-[35rem] rounded-md object-contain"
                />
              </div>
              <div
                v-else
                class="relative mb-5 block w-full cursor-pointer appearance-none rounded-md border-2 border-dashed border-primary bg-gray py-4 px-4"
              >
                <input
                  type="file"
                  accept="image/*"
                  class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none"
                  @change="handlePhotoChange"
                />
                <div class="flex flex-col items-center justify-center space-y-3">
                  <span
                    class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-slate-200 bg-white"
                  >
                    <IconUpload size="20" stroke="2" class="text-slate-400" />
                  </span>
                  <p class="text-sm font-medium">
                    <span class="text-primary"> Subir foto </span>
                  </p>
                </div>
              </div>
              <div
                class="flex gap-4 items-center justify-end col-span-2"
                v-if="form.photo != null && typeof form.photo == 'object'"
              >
                <SecondaryButton text="Cancelar" @click="cancelUpdatePhoto" />
                <PrimaryButton
                  :loading="isUploadingPhoto"
                  text="Guardar"
                  type="button"
                  @click="updatePhoto"
                />
              </div>
              <div class="flex justify-end" v-else-if="preview">
                <button type="button" class="text-primary font-medium" @click="confirmRemoveImage">
                  Eliminar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="tab == 'eventos'">
        <TableSection>
          <template #header>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Acciones</th>
          </template>

          <template #body>
            <tr v-if="events.data.length == 0">
              <td class="text-center text-slate-400" colspan="6">
                No hay datos que mostrar
              </td>
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
                  <ActionIcon :icon="IconEdit" @click="editEvent(item)" tooltip="Editar" />
                  <ActionIcon :icon="IconTrash" @click="destroyEvent(item.id)" tooltip="Eliminar" />
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
      <InputForm v-model="formEvent.description" label="Descripción" required name="description" />
      <InputForm
        v-model="formEvent.quantity"
        label="Cantidad"
        name="quantity"
        type="number"
        required
      />
    </ModalForm>
      </div>
    </div>
  </DefaultLayout>
</template>
