<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center rounded-md border border-gray-600 bg-gray-800 px-6 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-lg transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:ring-offset-2 disabled:opacity-50">
        <slot />
    </button>
</template>
