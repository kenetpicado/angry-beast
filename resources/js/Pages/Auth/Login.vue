<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputForm from "@/Components/Form/InputForm.vue";
import {IconLock, IconMail} from "@tabler/icons-vue";

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
        onError: (err) => {
            console.log(err)
        }
    });
};

const description = "Accede rápidamente a tu cuenta. Con nuestra plataforma, gestionar tus paquetes es más fácil que nunca. Inicia sesión ahora para tener control sobre tus envíos. Simplifica tu logística con nosotros."

</script>

<template>
    <GuestLayout subtitle="¡Bienvenido de vuelta!" title="Iniciar sesión" :description="description">
        <Head title="Iniciar sesión"/>

        <form @submit.prevent="submit">
            <InputForm v-model="form.email" label="Correo" name="email" required type="email">
                <IconMail class="text-stroke" size="25" stroke="2"/>
            </InputForm>

            <InputForm v-model="form.password" label="Contraseña" name="password" required type="password">
                <IconLock class="text-stroke" size="25" stroke="2"/>
            </InputForm>

            <PrimaryButton class="w-full mt-4" text="Iniciar sesión" type="submit"/>
        </form>

        <div class="mt-6 text-center">
            <p class="font-medium">
                No tienes cuenta?
                <Link :href="route('register')" class="text-primary">Regístrate</Link>
            </p>
        </div>
    </GuestLayout>
</template>
