<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import InputForm from '@/Components/Form/InputForm.vue'
import { IconLock, IconMail } from '@tabler/icons-vue'

const form = useForm({
  email: '',
  password: ''
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
    onError: (err) => {
      console.log(err)
    }
  })
}
</script>

<template>
  <GuestLayout subtitle="¡Bienvenido de vuelta!" title="Iniciar sesión">
    <Head title="Iniciar sesión" />

    <template #left>
      <img alt="illustration" class="w-96 mx-auto" src="/images/login.svg" />
    </template>

    <form @submit.prevent="submit">
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

      <PrimaryButton class="w-full mt-4" text="Iniciar sesión" type="submit" />
    </form>

    <div class="mt-4 text-center">
      <p class="font-medium">
        No tienes cuenta?
        <Link :href="route('register')" class="text-green-700">Regístrate</Link>
      </p>
    </div>
  </GuestLayout>
</template>
