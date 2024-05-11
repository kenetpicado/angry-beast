<script setup>
import {Link} from "@inertiajs/vue3";
const props = defineProps(['item', 'active'])

</script>

<template>
    <li>
        <Link :href="item.route"
              class="group relative flex items-center gap-2 rounded-lg py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark"
              :class="{'bg-graydark': active}">

            <component :is="item.icon" size="25" stroke="2"/>

            {{ item.label }}
        </Link>
    </li>
</template>
