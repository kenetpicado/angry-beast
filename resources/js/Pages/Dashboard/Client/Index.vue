<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import { ref, watch } from "vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import InputForm from "@/Components/Form/InputForm.vue";
import { useForm } from "@inertiajs/vue3";
import { created, deleted, updated } from "@/Utils/toast.js";
import { IconEdit, IconTrash } from "@tabler/icons-vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    clients: {
        type: Object,
        required: true
    }
})

const openModal = ref(false)

const form = useForm({
    id: null,
    name: '',
    phone: ''
})

function onSubmit() {
    if (form.id) {
        form.put(route('dashboard.clients.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                updated()
                resetValues()
            }
        })
    } else {
        form.post(route('dashboard.clients.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                created()
                resetValues()
            }
        })
    }
}

function edit(client) {
    form.id = client.id
    form.name = client.name
    form.phone = client.phone
    openModal.value = true
}

function destroy(client_id) {
    confirm('¿Estas seguro de eliminar este cliente?') && form.delete(route('dashboard.clients.destroy', client_id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            deleted()
        }
    })
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
                Clientes
            </h2>

            <PrimaryButton text="Nuevo" @click="openModal = true" />
        </div>
        <div class="bg-white p-0 lg:p-4 rounded-xl flex flex-col">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto text-left text-sm lg:text-base">
                    <thead class="uppercase text-xs tracking-widest">
                        <tr>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="clients.data.length == 0">
                            <td colspan="3" class="text-center text-slate-400">
                                No hay datos que mostrar
                            </td>
                        </tr>
                        <tr v-for="client in clients.data" :key="client.id">
                            <td>
                                {{ client.name }}
                            </td>
                            <td>
                                {{ client.phone }}
                            </td>
                            <td>
                                <div class="flex gap-3">
                                    <IconEdit role="button" size="25" stroke="2" @click="edit(client)" />
                                    <IconTrash role="button" size="25" stroke="2" @click="destroy(client.id)" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :links="clients.links" />
        </div>

        <Modal v-model="openModal" class="z-30">
            <form class="bg-white rounded-xl p-5 w-full flex flex-col" style="max-width: 35rem; min-height: 20rem"
                @submit.prevent="onSubmit">
                <div class="mb-3">
                    <h2 class="text-2xl font-semibold">
                        Cliente
                    </h2>
                </div>
                <div class="flex-1">
                    <div class="grid grid-cols-1 gap-4">
                        <InputForm v-model="form.name" label="Nombre" name="name" required />
                        <InputForm v-model="form.phone" label="Telefono" name="phone" type="number" />
                    </div>
                </div>
                <div class="flex gap-3 items-center justify-end mt-8">
                    <SecondaryButton text="Cancelar" @click="resetValues" />
                    <PrimaryButton text="Guardar" type="submit" />
                </div>
            </form>
        </Modal>
    </DefaultLayout>
</template>
