<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-white transition duration-150 ease-in-out bg-[#1b2838] hover:bg-[#2a475e] focus:bg-[#2a475e] focus:outline-none">
    <slot />
    </Link>
</template>
