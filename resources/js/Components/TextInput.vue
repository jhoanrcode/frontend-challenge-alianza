<template>
  <input
      class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-indigo-400 focus-within:text-primary-600"
      :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
</template>

<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>
