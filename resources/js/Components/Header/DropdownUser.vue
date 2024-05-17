<script setup>
import { onClickOutside } from "@vueuse/core";
import { IconChevronDown, IconLogout, IconUser } from "@tabler/icons-vue";
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";

const target = ref(null);
const dropdownOpen = ref(false);

onClickOutside(target, () => {
    dropdownOpen.value = false;
});

function logout() {
    router.post(route("logout"));
}
</script>

<template>
    <div class="relative cursor-pointer" ref="target">
        <div
            class="flex items-center gap-2"
            @click.prevent="dropdownOpen = !dropdownOpen"
        >
            <span class="hidden text-right lg:block">
                <span class="block text-sm font-medium">
                    {{ $page.props.auth.name }}
                </span>
                <span class="block text-xs font-medium"> Administrador </span>
            </span>

            <span class="h-12 w-12 rounded-full overflow-hidden">
                <img src="/profile.png" alt="User" />
            </span>

            <IconChevronDown
                :class="dropdownOpen && 'rotate-180'"
                class="hidden fill-current sm:block"
                width="20"
            />
        </div>

        <div
            v-show="dropdownOpen"
            class="absolute right-0 mt-4 flex w-52 flex-col rounded-xl border border-stroke bg-white shadow-default"
        >
            <ul class="flex flex-col gap-5 border-b border-stroke px-5 py-3">
                <li>
                    <Link
                        :href="route('profile.edit')"
                        class="flex items-center gap-3 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base"
                    >
                        <IconUser size="25" class="font-bold" stroke="2" />
                        Perfil
                    </Link>
                </li>
            </ul>
            <button
                type="button"
                @click="logout"
                class="flex items-center gap-3 py-3 px-5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base"
            >
                <IconLogout size="25" stroke="2" />
                Salir
            </button>
        </div>
    </div>
</template>
