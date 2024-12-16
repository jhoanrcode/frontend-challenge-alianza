<template>
  <button :type="type" class="rounded-lg border border-transparent bg-indigo-700 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-indigo-600 focus:outline-none focus:ring active:bg-indigo-500">
    <slot/>
  </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
