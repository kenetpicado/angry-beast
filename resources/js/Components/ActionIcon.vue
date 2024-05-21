<template>
    <component :is="href ? Link : 'button'" type="button" :href="href" :tooltip="tooltip">
        <component :is="icon" size="25" stroke="2" />
    </component>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { IconSettings } from '@tabler/icons-vue';

defineProps({
    icon: {
        default: IconSettings
    },
    tooltip: {
        type: String,
        required: false
    },
    href: {
        type: String,
        required: false
    }
})

</script>