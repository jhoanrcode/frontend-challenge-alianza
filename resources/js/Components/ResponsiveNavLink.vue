<template>
  <span v-show="active" class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-indigo-400" aria-hidden="true"></span>
  <div class="flex">
    <slot name="icon" />
    <Link :href="href" class="inline-flex w-full items-center justify-between transition-colors duration-150 hover:text-indigo-400">
      <span>
        <slot />
      </span>
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);
</script>
