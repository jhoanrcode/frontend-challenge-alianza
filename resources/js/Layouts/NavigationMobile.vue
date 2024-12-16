<template>
  <transition
      enter-active-class="transition ease-in-out duration-150"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in-out duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0">
    <div v-show="$page.props.showingMobileMenu" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
  </transition>
  <transition
      enter-active-class="transition ease-in-out duration-150"
      enter-from-class="opacity-0 transform -translate-x-20"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in-out duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0 transform -translate-x-20">
    <aside v-show="$page.props.showingMobileMenu" class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-indigo-700 md:hidden">
      <div class="py-4 text-white text-base font-semibold">
        <ul class="mt-2">
          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Home</ResponsiveNavLink>
          </li>

          <li class="relative px-6 py-3">
            <button @click="showingTwoLevelMenu = !showingTwoLevelMenu"
                class="inline-flex items-center justify-between w-full transition-colors duration-150 hover:text-indigo-400"
                aria-haspopup="true">
              <span>Listas</span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
              </svg>
            </button>
              <ul v-show="showingTwoLevelMenu || route().current('empleados.index') || route().current('cargos.index')" class="p-2 mt-2 space-y-2 overflow-hidden font-normal text-sm rounded-md"
                  aria-label="submenu">
                  <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-400">
                    <ResponsiveNavLink :href="route('empleados.index')" :active="route().current('empleados.index')">Empleados</ResponsiveNavLink>
                  </li>
                  <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-400">
                    <ResponsiveNavLink :href="route('cargos.index')" :active="route().current('cargos.index')">Cargos</ResponsiveNavLink>
                  </li>
              </ul>
          </li>
        </ul>
      </div>
    </aside>
  </transition>
</template>

<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

let showingTwoLevelMenu = ref(false)
</script>
