<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import InputForm from '@/Components/Form/InputForm.vue'
import { IconLock, IconMail } from '@tabler/icons-vue'
import toast from '@/Utils/toast.js'
import { computed, watch } from 'vue'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

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

watch(
  () => form.company,
  (value) => {
    form.company = value.toUpperCase()
  }
)

const submit = () => {
  form.post(route('register.store'), {
    onSuccess: () => {
      toast.success('Cuenta creada correctamente')
    },
    onError: (err) => {
      console.log(err)
    }
  })
}
</script>

<template>
  <GuestLayout subtitle="Únete hoy mismo" title="Crear cuenta">
    <Head title="Crear cuenta" />

    <template #left>
      <img alt="illustration" class="w-96 mx-auto" src="/images/register.svg" />
    </template>

    <form @submit.prevent="submit">
      <InputForm v-model="form.name" autofocus label="Nombre completo" name="name" required />

      <InputForm v-model="form.email" label="Correo" name="email" required type="email">
        <IconMail class="text-stroke" size="25" stroke="2" />
      </InputForm>

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

      <div v-if="passwordStatus && form.password" class="mb-2 text-red-400 text-sm">
        {{ passwordStatus }}
      </div>

      <PrimaryButton
        :disabled="passwordStatus != null"
        class="w-full mt-4"
        text="Crear cuenta"
        type="submit"
      />
    </form>

    <div class="mt-4 text-center">
      <p class="font-medium">
        Ya tienes cuenta?
        <Link :href="route('login')" class="text-green-700">Inicia sesión</Link>
      </p>
    </div>
  </GuestLayout>
</template>
