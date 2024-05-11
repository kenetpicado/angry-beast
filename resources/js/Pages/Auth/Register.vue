<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputForm from "@/Components/Form/InputForm.vue";
import {IconLock, IconMail} from "@tabler/icons-vue";
import toast from "@/Utils/toast.js";
import {computed, watch} from "vue";

const form = useForm({
    name: '',
    company: '',
    email: '',
    password: '',
    password_confirmation: '',
});

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

watch(() => form.company, (value) => {
    form.company = value.toUpperCase()
})

const submit = () => {

    form.post(route('register.store'), {
        onSuccess: () => {
            toast.success("Cuenta creada correctamente")
        },
        onError: (err) => {
            console.log(err)
        }
    });
};

const description = "Descubre una forma más eficiente de gestionar tus envíos. Regístrate ahora para acceder a herramientas poderosas que te ayudarán a administrar y optimizar tus registros con facilidad. Únete hoy mismo y lleva tu negocio al siguiente nivel."

</script>

<template>
    <GuestLayout subtitle="Únete hoy mismo" title="Crear cuenta" :description="description">
        <Head title="Crear cuenta"/>

        <form @submit.prevent="submit">

            <InputForm v-model="form.name" autofocus label="Nombre" name="name" required/>

            <InputForm v-model="form.company" label="Nombre de tu empresa" name="company" required/>

            <InputForm v-model="form.email" label="Correo" name="email" required type="email">
                <IconMail class="text-stroke" size="25" stroke="2"/>
            </InputForm>

            <InputForm v-model="form.password" label="Contraseña" name="password" required type="password">
                <IconLock class="text-stroke" size="25" stroke="2"/>
            </InputForm>

            <div v-if="passwordStatus && form.password" class="mb-5 text-red-400 text-sm">
                {{ passwordStatus }}
            </div>

            <InputForm v-model="form.password_confirmation" label="Confirmar contraseña" name="password_confirmation"
                       required type="password">
                <IconLock class="text-stroke" size="25" stroke="2"/>
            </InputForm>

            <PrimaryButton :disabled="passwordStatus != null" class="w-full mt-4" text="Crear cuenta" type="submit"/>
        </form>

        <div class="mt-6 text-center">
            <p class="font-medium">
                Ya tienes cuenta?
                <Link :href="route('login')" class="text-primary">Inicia sesión</Link>
            </p>
        </div>
    </GuestLayout>
</template>
