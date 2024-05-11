<script setup>
import {computed} from "vue";

const props = defineProps({
    label: {
        default: 'select'
    },
    autofocus: {
        default: false
    },
    disabled: {
        default: false
    },
    required: {
        default: false
    },
    modelValue: {
        type: [String, Number], required: false
    },
    name: {
        required: false
    }
})

const keyValue = computed(() => {
    return props.name ?? format_key(props.label)
})

function format_key(string) {
    return string.toLowerCase().replace(/ /g, '_')
}

</script>

<template>
    <div class="mb-4">
        <label class="mb-1 block font-medium">{{ label }}</label>

        <div class="relative">
            <select :disabled="disabled" :autofocus="autofocus" :required="required" @input="$emit('update:modelValue', $event.target.value)" :value="modelValue"
                   class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-5 pr-10 outline-none focus:border-primary focus-visible:shadow-none text-black">
                <slot></slot>
            </select>
        </div>
        <div class="text-red-400 mt-2 text-xs" v-if="$page.props.errors[keyValue]">
            {{ $page.props.errors[keyValue] }}
        </div>
    </div>
</template>
