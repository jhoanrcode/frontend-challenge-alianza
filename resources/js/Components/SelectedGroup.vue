<template>
    <select ref="input" :value="modelValue" @change="$emit('update:modelValue', $event.target.value);" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-indigo-400 focus-within:text-primary-600">
        <template v-for="option in listOptions">
            <!-- Listado agrupado -->
            <optgroup v-if="option.group" :label="option.group" :key="option.group">
                <option v-for="list in option.options" :value="list.value" :key="list.value">{{ list.text }}</option>
            </optgroup>
            <!-- Listado simple -->
            <option v-else :value="option.value" :key="option.value">{{ option.text }}</option>
        </template>
    </select> 
</template>

<script setup>
    const props = defineProps({
        listOptions: Array,
        modelValue: [String, Number],
    });
    defineEmits(['update:modelValue']);
</script>
