<script setup>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
import InputForm from '@/Components/Form/InputForm.vue'
import SelectForm from '@/Components/Form/SelectForm.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { created } from '@/Utils/toast.js'
import { useForm } from '@inertiajs/vue3'
import { IconUpload } from '@tabler/icons-vue'
import { ref } from 'vue'

const preview = ref('')

const form = useForm({
    name: '',
    code: '',
    gender: 'Hembra',
    race: '',
    initial_weight: '',
    initial_height: '',
    birth_date: '',
    adoption_date: '',
    entry_date: '',
    photo: ''
})

function handleSubmit() {
    form.post(route('dashboard.animals.store'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            created()
        }
    })
}

function handlePhotoChange(event) {
    form.photo = event.target.files[0]
    const reader = new FileReader()
    reader.readAsDataURL(form.photo)
    reader.onload = () => { preview.value = reader.result }
}

function removeImage() {
    preview.value = ''
    form.photo = ''
}

</script>

<template>
    <DefaultLayout head="Perfil">
        <div class="mx-auto max-w-270">
            <div class="grid grid-cols-5 gap-8">

                <div class="col-span-5 xl:col-span-3">
                    <div class="rounded-md border border-stroke bg-white shadow-default">
                        <div class="border-b border-stroke py-4 px-7">
                            <h3 class="font-medium">
                                Datos generales
                            </h3>
                        </div>
                        <div class="p-7">
                            <form @submit.prevent="handleSubmit">
                                <div class="grid grid-cols-2 gap-4">
                                    <InputForm v-model="form.name" label="Nombre" name="name" required />
                                    <InputForm v-model="form.code" label="Codigo" name="code" required />
                                    <SelectForm v-model="form.gender" label="Genero" name="gender" required>
                                        <option value="Macho">Macho</option>
                                        <option value="Hembra">Hembra</option>
                                    </SelectForm>
                                    <InputForm v-model="form.race" label="Raza" name="race" />
                                    <InputForm v-model="form.initial_weight" label="Peso Inicial" name="initial_weight"
                                        type="number" />
                                    <InputForm v-model="form.initial_height" label="Altura Inicial"
                                        name="initial_height" type="number" />
                                    <InputForm v-model="form.birth_date" label="Fecha de nacimiento" name="birth_date"
                                        type="date" />
                                    <InputForm v-model="form.adoption_date" label="Fecha de adopción"
                                        name="adoption_date" type="date" />
                                    <InputForm v-model="form.entry_date" label="Fecha de ingreso" name="entry_date"
                                        type="date" />
                                </div>

                                <div class="flex justify-end gap-4">
                                    <SecondaryButton text="Cancelar" />
                                    <PrimaryButton :loading="form.processing" text="Guardar" type="submit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-span-5 xl:col-span-2">
                    <div class="rounded-md border border-stroke bg-white shadow-default">
                        <div class="border-b border-stroke py-4 px-7">
                            <h3 class="font-medium">
                                Foto
                            </h3>
                        </div>
                        <div class="p-7">
                            <div v-if="preview" class="mb-4 w-full flex justify-center">
                                <img :src="preview" alt="" class="mb-2 w-auto h-[35rem] rounded-md">
                            </div>
                            <div v-else
                                class="relative mb-5 block w-full cursor-pointer appearance-none rounded-md border-2 border-dashed border-primary bg-gray py-4 px-4">
                                <input type="file" accept="image/*"
                                    class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none"
                                    @change="handlePhotoChange" />
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <span
                                        class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-slate-200 bg-white">
                                        <IconUpload size="20" stroke="2" class="text-slate-400" />
                                    </span>
                                    <p class="text-sm font-medium">
                                        <span class="text-primary">
                                            Subir foto
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" class="text-primary font-medium"
                                    @click="removeImage">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
