<script setup>
defineProps({
    text: {
        required: true
    },
    disabled: {
        default: false
    },
    type: {
        default: 'button'
    }
})

</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        class="border border-green-700 bg-green-700 text-white rounded-md inline-flex items-center justify-center gap-2 py-3 px-6 text-center font-medium hover:bg-opacity-90 lg:px-8">
        {{ text }}
    </button>
</template>
