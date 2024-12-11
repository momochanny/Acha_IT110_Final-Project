<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-3 py-2 border-l-4 border-blue-500 text-sm font-medium leading-5 text-white bg-[#2a475e] focus:outline-none focus:bg-[#1b2838] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-3 py-2 border-l-4 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-white hover:bg-[#1b2838] focus:outline-none focus:bg-[#2a475e] transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
