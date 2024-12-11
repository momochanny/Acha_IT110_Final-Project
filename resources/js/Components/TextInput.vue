<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="w-full px-4 py-2 rounded-md bg-gray-800 text-white border border-gray-600 shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
        v-model="model" ref="input" />
</template>
