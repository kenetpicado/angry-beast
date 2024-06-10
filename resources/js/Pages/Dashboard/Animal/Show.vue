<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { defineProps, ref } from 'vue'
import InputForm from '@/Components/Form/InputForm.vue'
import SelectForm from '@/Components/Form/SelectForm.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import { IconUpload } from '@tabler/icons-vue'
import useAnimal from '@/Composables/useAnimal.js'
import { getBasicDate } from '@/Utils/date.js'
import Tabs from '@/Components/Tabs.vue'
import { IconDetails, IconVaccine } from '@tabler/icons-vue'
import { router } from '@inertiajs/vue3'

const edit = ref(false)
const tab = ref('detalles')

defineProps(['animal', 'species'])
const { preview, confirmRemoveImage, handlePhotoChange, form, updatePhoto, update } = useAnimal()

function cancelUpdatePhoto() {
  preview.value = ''
  form.photo = ''
}

const tabs = [
  {
    label: 'Detalles',
    value: 'detalles',
    icon: IconDetails
  },
  {
    label: 'Vacunas',
    value: 'vacunas',
    icon: IconVaccine
  }
]

function afterUpdate() {
  router.reload({ only: ['animal'] })
  edit.value = false
}
</script>

<template>
  <DefaultLayout head="Detalles">
    <div class="mx-auto max-w-270">
      <div class="mb-4 flex gap-3 items-center justify-between h-12">
        <h2 class="text-2xl font-semibold">{{ animal.name }}</h2>
        <PrimaryButton v-if="tab == 'vacunas'" text="Nuevo" />
      </div>

      <Tabs :options="tabs" v-model="tab" />

      <div class="grid grid-cols-5 gap-8">
        <div class="col-span-5 xl:col-span-3">
          <div class="rounded-md border border-stroke bg-white shadow-default">
            <div class="border-b border-stroke py-4 px-7">
              <h3 class="font-medium">Datos generales</h3>
            </div>
            <div class="p-7">
              <form @submit.prevent="update(() => afterUpdate())">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <template v-if="!edit">
                    <div>
                      <label class="text-base font-bold">Nombre</label>
                      <p class="text-base">{{ animal.name }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Código</label>
                      <p class="text-base">{{ animal.code }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Especie</label>
                      <p class="text-base">{{ animal.specie?.name || 'Ninguna' }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Género</label>
                      <p class="text-base">{{ animal.gender }}</p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Raza</label>
                      <p class="text-base">
                        {{ animal.race || 'Sin registrar' }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Peso inicial</label>
                      <p class="text-base">
                        {{ animal.initial_weight || 'Sin registrar' }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Altura inicial</label>
                      <p class="text-base">
                        {{ animal.initial_height || 'Sin registrar' }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Fecha de nacimiento</label>
                      <p class="text-base">
                        {{ getBasicDate(animal.birth_date) }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Fecha de adopción</label>
                      <p class="text-base">
                        {{ getBasicDate(animal.adoption_date) }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Fecha de ingreso</label>
                      <p class="text-base">
                        {{ getBasicDate(animal.entry_date) }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Fecha de salida</label>
                      <p class="text-base">
                        {{ getBasicDate(animal.exit_date) }}
                      </p>
                    </div>
                    <div>
                      <label class="text-base font-bold">Fecha de muerte</label>
                      <p class="text-base">
                        {{ getBasicDate(animal.death_date) }}
                      </p>
                    </div>
                    <div class="mb-4">
                      <label class="text-base font-bold">Causa de muerte</label>
                      <p class="text-base">
                        {{ animal.cause_of_death || 'Sin registrar' }}
                      </p>
                    </div>
                  </template>
                  <template v-else>
                    <InputForm v-model="form.name" label="Nombre" name="name" required />
                    <InputForm v-model="form.code" label="Código" name="code" required />
                    <SelectForm v-model="form.specie_id" label="Especie" name="specie_id">
                      <option value="">Ninguna</option>
                      <option v-for="specie in species" :value="specie.id" :key="specie.id">
                        {{ specie.name }}
                      </option>
                    </SelectForm>
                    <SelectForm v-model="form.gender" label="Genero" name="gender" required>
                      <option value="Macho">Macho</option>
                      <option value="Hembra">Hembra</option>
                    </SelectForm>
                    <InputForm v-model="form.race" label="Raza" name="race" />
                    <InputForm
                      v-model="form.initial_weight"
                      label="Peso Inicial"
                      name="initial_weight"
                      type="number"
                    />
                    <InputForm
                      v-model="form.initial_height"
                      label="Altura Inicial"
                      name="initial_height"
                      type="number"
                    />
                    <InputForm
                      v-model="form.birth_date"
                      label="Fecha de nacimiento"
                      name="birth_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.adoption_date"
                      label="Fecha de adopción"
                      name="adoption_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.entry_date"
                      label="Fecha de ingreso"
                      name="entry_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.exit_date"
                      label="Fecha de salida"
                      name="exit_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.death_date"
                      label="Fecha de muerte"
                      name="death_date"
                      type="date"
                    />
                    <InputForm
                      v-model="form.cause_of_death"
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
              <button v-if="!edit" type="button" class="text-primary" @click="edit = true">
                Editar
              </button>
            </div>
          </div>
        </div>

        <div class="col-span-5 xl:col-span-2">
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
                  :loading="form.processing"
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
    </div>
  </DefaultLayout>
</template>
