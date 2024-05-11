<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import {ref, watch} from "vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import InputForm from "@/Components/Form/InputForm.vue";
import {useForm} from "@inertiajs/vue3";
import {created, updated} from "@/Utils/toast.js";
import {IconEdit} from "@tabler/icons-vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    companies: {
        type: Object,
        required: true
    }
})

const openModal = ref(false)

const form = useForm({
    id: null,
    name: '',
})

function onSubmit() {
    if (form.id) {
        form.put(route('dashboard.companies.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                updated()
                resetValues()
            }
        })
    } else {
        form.post(route('dashboard.companies.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                created()
                resetValues()
            }
        })
    }
}

function edit(company) {
    form.id = company.id
    form.name = company.name
    openModal.value = true
}

function resetValues() {
    openModal.value = false
    form.reset()
}

watch(() => form.name, (value) => {
    form.name = value.toUpperCase()
})

</script>

<template>
    <DefaultLayout>
        <div class="mb-6 flex gap-3 items-center justify-between">
            <h2 class="text-xl font-semibold">
                Compañias
            </h2>
            <PrimaryButton text="Nuevo" @click="openModal = true"/>
        </div>
        <div class="bg-white p-0 lg:p-4 rounded-xl flex flex-col">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto text-left text-sm lg:text-base">
                    <thead class="uppercase text-xs tracking-widest">
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="companies.data.length == 0">
                        <td class="text-center text-slate-400" colspan="3">
                            No hay datos que mostrar
                        </td>
                    </tr>
                    <tr v-for="item in companies.data" :key="item.id">
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            <div class="flex gap-3">
                                <IconEdit role="button" size="25" stroke="2" @click="edit(item)"/>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :links="companies.links"/>
        </div>

        <Modal v-model="openModal" class="z-30">
            <form class="bg-white rounded-xl p-5 w-full flex flex-col" style="max-width: 35rem; min-height: 20rem"
                  @submit.prevent="onSubmit">
                <div class="mb-3">
                    <h2 class="text-2xl font-semibold">
                        Compañia
                    </h2>
                </div>
                <div class="flex-1">
                    <div class="grid grid-cols-1 gap-4">
                        <InputForm v-model="form.name" label="Nombre" name="name" required/>
                    </div>
                </div>
                <div class="flex gap-3 items-center justify-end">
                    <SecondaryButton text="Cancelar" @click="resetValues"/>
                    <PrimaryButton text="Guardar" type="submit"/>
                </div>
            </form>
        </Modal>
    </DefaultLayout>
</template>
