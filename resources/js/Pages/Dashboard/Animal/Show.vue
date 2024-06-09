<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { IconEdit } from '@tabler/icons-vue'
import { defineProps, ref } from 'vue'
import InputForm from '@/Components/Form/InputForm.vue'
import SelectForm from '@/Components/Form/SelectForm.vue'

const edit = ref(false)

const props = defineProps({
  animal: {
    type: Object,
    required: true
  }
})

const form = useForm({
  name: props.animal.name,
  code: props.animal.code,
  gender: props.animal.gender || 'Hembra',
  race: props.animal.race || '',
  initial_weight: props.animal.initial_weight || '',
  initial_height: props.animal.initial_height || '',
  birth_date: props.animal.birth_date || '',
  adoption_date: props.animal.adoption_date || '',
  entry_date: props.animal.entry_date || '',
  exit_date: props.animal.exit_date || '',
  death_date: props.animal.death_date || '',
  cause_of_death: props.animal.cause_of_death || '',
  photo: props.animal.photo || ''
})
</script>

<template>
  <DefaultLayout head="Detalles">
    <div class="mx-auto max-w-270">
      <div class="rounded-md border border-stroke bg-white shadow-default">
        <div class="border-b border-stroke py-4 px-7">
          <h3 class="font-medium">Detalles</h3>
        </div>
        <div class="p-7">
          <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 lg:col-span-3">
              <div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <template v-if="!edit">
                    <div>
                      <label class="text-base font-medium">Nombre</label>
                      <p class="text-base">{{ animal.name }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Código</label>
                      <p class="text-base">{{ animal.code }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Género</label>
                      <p class="text-base">{{ animal.gender }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Raza</label>
                      <p class="text-base">{{ animal.race }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Peso inicial</label>
                      <p class="text-base">{{ animal.initial_weight }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Altura inicial</label>
                      <p class="text-base">{{ animal.initial_height }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Fecha de nacimiento</label>
                      <p class="text-base">{{ animal.birth_date }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Fecha de adopción</label>
                      <p class="text-base">{{ animal.adoption_date }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Fecha de ingreso</label>
                      <p class="text-base">{{ animal.entry_date }}</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Fecha de salida</label>
                      <p v-if="animal.exit_date" class="text-base">{{ animal.exit_date }}</p>
                      <p v-else class="text-base">Sin registrar</p>
                    </div>
                    <div>
                      <label class="text-base font-medium">Fecha de muerte</label>
                      <p v-if="animal.death_date" class="text-base">{{ animal.death_date }}</p>
                      <p v-else class="text-base">Sin registrar</p>
                    </div>
                    <div class="mb-4">
                      <label class="text-base font-medium">Causa de muerte</label>
                      <p v-if="animal.death_cause" class="text-base">{{ animal.death_cause }}</p>
                      <p v-else class="text-base">Sin registrar</p>
                    </div>
                  </template>
                  <template v-else>
                    <InputForm v-model="form.name" label="Nombre" name="name" required />
                    <InputForm v-model="form.code" label="Codigo" name="code" required />
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
                  </template>
                </div>
                <button @click="edit = !edit" type="button" class="col-span-2 text-primary">
                  {{ !edit ? 'Editar' : 'Cancelar' }}
                </button>
              </div>
            </div>
            <div class="col-span-4 lg:col-span-1">
              <img :src="animal.photo" alt="" class="rounded-md" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>
