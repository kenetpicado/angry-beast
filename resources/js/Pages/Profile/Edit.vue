<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import { useForm } from '@inertiajs/vue3'
import { updated } from '@/Utils/toast.js'
import { computed, watch } from 'vue'

const props = defineProps(['auth', 'company'])

const form = useForm({
  name: props.auth.name,
  email: props.auth.email,
  company: props.company.name
})

const formPassword = useForm({
  current_password: '',
  password: '',
  password_confirmation: ''
})

function handleSubmitProfile() {
  form.put(route('profile.update'), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      updated()
    }
  })
}

watch(
  () => form.company,
  (value) => {
    form.company = value.toUpperCase()
  }
)

const passwordStatus = computed(() => {
  if (formPassword.password.length < 8) {
    return 'La contraseña debe contener al menos 8 caracteres'
  }

  if (!/\d/.test(formPassword.password)) {
    return 'La contraseña debe contener al menos un número'
  }

  if (!/[A-Z]/.test(formPassword.password)) {
    return 'La contraseña debe contener al menos una letra mayúscula'
  }

  if (!/[a-z]/.test(formPassword.password)) {
    return 'La contraseña debe contener al menos una letra minúscula'
  }

  if (formPassword.password !== formPassword.password_confirmation) {
    return 'La confirmación de contraseña debe coincidir'
  }

  return null
})
</script>

<template>
  <DefaultLayout>
    <div class="mx-auto max-w-270">
      <div class="grid grid-cols-4 gap-8">
        <form class="col-span-4 xl:col-span-2" @submit.prevent="handleSubmitProfile">
          <div class="flex flex-col rounded-sm border border-stroke bg-white h-full">
            <div class="border-b border-stroke py-4 px-7">
              <h3 class="font-medium text-black">Informacion personal</h3>
            </div>
            <div class="flex-1 p-7">
              <InputForm v-model="form.name" label="Nombre" name="name" required />
              <InputForm v-model="form.email" label="Correo" name="email" required />
              <InputForm
                v-model="form.company"
                label="Nombre de tu empresa"
                name="company"
                required
              />
            </div>
            <div class="p-7 flex justify-end gap-4">
              <SecondaryButton text="Cancelar" />
              <PrimaryButton text="Guardar" type="submit" />
            </div>
          </div>
        </form>
        <form class="col-span-4 xl:col-span-2 h-full" @submit.prevent="handleSubmit">
          <div class="flex flex-col rounded-sm border border-stroke bg-white h-full">
            <div class="border-b border-stroke py-4 px-7">
              <h3 class="font-medium text-black">Contraseña</h3>
            </div>
            <div class="flex-1 p-7">
              <InputForm
                v-model="formPassword.current_password"
                label="Contraseña actual"
                name="current_password"
                required
                type="password"
              />
              <InputForm
                v-model="formPassword.password"
                label="Nueva contraseña"
                name="password"
                required
                type="password"
              />
              <InputForm
                v-model="formPassword.password_confirmation"
                label="Confirmar contraseña"
                name="password_confirmation"
                required
                type="password"
              />
              <div v-if="passwordStatus && formPassword.password" class="mb-5 text-red-400 text-sm">
                {{ passwordStatus }}
              </div>
            </div>
            <div class="p-7 flex justify-end gap-4">
              <SecondaryButton text="Cancelar" />
              <PrimaryButton text="Guardar" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </DefaultLayout>
</template>
