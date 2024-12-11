<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input type="checkbox" :value="value" v-model="proxyChecked"
        class="rounded border-transparent bg-[#2a475e] text-blue-500 shadow-sm focus:ring-blue-500 focus:outline-none hover:bg-[#1b2838] hover:border-blue-500 checked:bg-[#1b2838] checked:text-blue-400" />
</template>
