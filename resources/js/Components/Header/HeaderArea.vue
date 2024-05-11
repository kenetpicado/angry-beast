<script setup>
import DropdownUser from "./DropdownUser.vue";
import useSidebarStore from "@/Stores/useSidebarStore.js";
import {IconList} from "@tabler/icons-vue";

const {toggleSidebar} = useSidebarStore()

</script>

<template>
    <header class="sticky top-0 z-10 flex w-full bg-white">
        <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11 w-full">
            <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                <button
                    class="z-99999 block rounded-sm border border-stroke bg-white p-2 shadow-sm lg:hidden"
                    @click="toggleSidebar">
                    <IconList size="25" class="text-dark" stroke="2"/>
                </button>
            </div>
            <div class="hidden sm:block">

            </div>

            <div class="flex items-center gap-3 sm:gap-7">
                <ul class="flex items-center gap-2 sm:gap-4">
                    <DropdownUser/>
                </ul>
            </div>
        </div>
    </header>
</template>
