<template>
  <input type="checkbox" :value="value" v-model="proxyChecked"
         class="text-indigo-700 form-checkbox focus:shadow-outline-indigo focus:border-indigo-400 focus:outline-none dark:focus:shadow-outline-gray" />
</template>

<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
  checked: {
    type: [Array, Boolean],
    default: false,
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
