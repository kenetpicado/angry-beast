<script setup>
import { ref } from 'vue'
import {
  IconCategory,
  IconCategory2,
  IconHome,
  IconHorse,
  IconLogout,
  IconUser,
  IconUserCog,
  IconUsers,
  IconX,
  IconBulb,
  IconCurrencyDollar,
  IconFlag,
  IconFileDollar,
  IconAlarm
} from '@tabler/icons-vue'
import SidebarItem from './SidebarItem.vue'
import { onClickOutside } from '@vueuse/core'
import useSidebarStore from '@/Stores/useSidebarStore.js'
import useLocalPage from '@/Composables/useLocalPage'

const target = ref(null)

const sidebarStore = useSidebarStore()
const { isType } = useLocalPage()

onClickOutside(target, () => {
  sidebarStore.isSidebarOpen = false
})

const menuGroups = ref([
  {
    name: 'Menu',
    menuItems: [
      {
        icon: IconHome,
        label: 'Inicio',
        route: route('dashboard.index'),
        show: true
      },
      {
        icon: IconUsers,
        label: 'Usuarios',
        route: route('dashboard.users.index'),
        show: isType('ADMIN')
      },
      {
        icon: IconCategory,
        label: 'Especies',
        route: route('dashboard.species.index'),
        show: true
      },
      {
        icon: IconHorse,
        label: 'Animales',
        route: route('dashboard.animals.index'),
        show: true
      },
      {
        icon: IconBulb,
        label: 'Eventos',
        route: route('dashboard.events.index'),
        show: true
      },
      {
        icon: IconFlag,
        label: 'Tipos de eventos',
        route: route('dashboard.event-types.index'),
        show: true
      },
      {
        icon: IconAlarm,
        label: 'Recordatorios',
        route: route('dashboard.reminders.index'),
        show: true
      }
    ]
  },
  {
    name: 'Contabilidad',
    menuItems: [
      {
        icon: IconCurrencyDollar,
        label: 'Transacciones',
        route: route('dashboard.transactions.index'),
        show: true
      },
      {
        icon: IconFileDollar,
        label: 'Conceptos',
        route: route('dashboard.concepts.index'),
        show: true
      },
      {
        icon: IconUserCog,
        label: 'Personal',
        route: route('dashboard.employees.index'),
        show: true
      }
    ]
  },
  {
    name: 'Configuración',
    menuItems: [
      {
        icon: IconUser,
        label: 'Perfil',
        route: route('profile.edit'),
        show: true
      }
    ]
  }
])
</script>

<template>
  <aside
    class="absolute left-0 top-0 z-20 flex h-screen w-64 flex-col overflow-y-hidden bg-primary duration-300 ease-linear lg:static lg:translate-x-0"
    :class="[sidebarStore.isSidebarOpen ? 'translate-x-0' : '-translate-x-full']"
    ref="target"
  >
    <div class="flex items-center justify-between gap-2 px-6 py-5 lg:py-6">
      <div class="text-center w-full text-white font-bold text-2xl">
        {{ $page.props.app_name }}
      </div>

      <button class="block lg:hidden" @click="sidebarStore.isSidebarOpen = false">
        <IconX class="text-white" size="25" stroke="2" />
      </button>
    </div>

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear text-white">
      <nav class="mt-0 py-4 px-4 lg:px-6">
        <template v-for="menuGroup in menuGroups" :key="menuGroup.name">
          <div>
            <h3 class="mb-4 ml-4 text-sm font-medium">
              {{ menuGroup.name }}
            </h3>

            <ul class="mb-4 flex flex-col gap-1">
              <template v-for="(menuItem, index) in menuGroup.menuItems" :key="index">
                <SidebarItem
                  v-if="menuItem.show"
                  :item="menuItem"
                  @click="() => (sidebarStore.page = menuItem.label)"
                  :active="menuItem.label === sidebarStore.page"
                />
              </template>
            </ul>
          </div>
        </template>
        <button
          @click="() => $inertia.post(route('logout'))"
          type="button"
          class="mt-2 w-full group relative flex items-center gap-2 rounded-md py-2 px-4 font-medium duration-300 ease-in-out hover:bg-primary-dark"
        >
          <IconLogout size="25" stroke="2" />
          Salir
        </button>
      </nav>
    </div>
  </aside>
</template>
