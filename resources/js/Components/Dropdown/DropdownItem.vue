<template>
    <MenuItem v-slot="{ active }">
    <component :is="href ? Link : 'button'" :href="href" type="button"
        :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
    <component :is="icon" size="20" :class="[active ? 'text-white' : '', 'mr-2']" />
    {{ title }}
    </component>
    </MenuItem>
</template>

<script setup>
import { MenuItem } from '@headlessui/vue';
import { Link } from '@inertiajs/vue3';
import { IconSettings } from '@tabler/icons-vue';

defineProps({
    title: {
        type: String,
        required: true
    },
    href: {
        type: String,
        required: false
    },
    icon: {
        default: IconSettings
    },
});

</script>