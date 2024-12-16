<template>
  <div class="flex md:items-center min-h-screen">
    <div class="flex-1 h-full overflow-hidden">
      <slot/>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
