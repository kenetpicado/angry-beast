<script setup>
import {ref} from 'vue'
import {IconHome, IconUsers, IconX} from "@tabler/icons-vue";
import SidebarItem from './SidebarItem.vue'
import {onClickOutside} from '@vueuse/core'
import useSidebarStore from "@/Stores/useSidebarStore.js";

const target = ref(null)

const sidebarStore = useSidebarStore()

onClickOutside(target, () => {
    sidebarStore.isSidebarOpen = false
})

const menuGroups = ref([
    {
        name: 'MENU',
        menuItems: [
            {
                icon: IconHome,
                label: 'Compañias',
                route: route('dashboard.companies.index')
            },
            {
                icon: IconUsers,
                label: 'Clientes',
                route: route('dashboard.clients.index')
            },
            {
                icon: IconUsers,
                label: 'Usuarios',
                route: route('dashboard.users.index')
            },
        ]
    },
])

</script>

<template>
    <aside
        class="absolute left-0 top-0 z-20 flex h-screen w-72 flex-col overflow-y-hidden bg-black duration-300 ease-linear lg:static lg:translate-x-0"
        :class="[sidebarStore.isSidebarOpen ? 'translate-x-0' : '-translate-x-full']"
        ref="target">

        <div class="flex items-center justify-between gap-2 px-6 py-5 lg:py-6">
            <div class="text-center w-full text-white font-bold text-2xl">
                {{ $page.props.app_name }}
            </div>

            <button class="block lg:hidden" @click="sidebarStore.isSidebarOpen = false">
                <IconX class="text-white" size="25" stroke="2"/>
            </button>
        </div>

        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <nav class="mt-5 py-4 px-4 lg:mt-7 lg:px-6">
                <template v-for="menuGroup in menuGroups" :key="menuGroup.name">
                    <div>
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">
                            {{ menuGroup.name }}
                        </h3>

                        <ul class="mb-6 flex flex-col gap-2">
                            <SidebarItem
                                v-for="(menuItem, index) in menuGroup.menuItems"
                                :item="menuItem"
                                :key="index"
                                @click="() => sidebarStore.page = menuItem.label"
                                :active="menuItem.label === sidebarStore.page"
                            />
                        </ul>
                    </div>
                </template>
            </nav>
        </div>
    </aside>
</template>
