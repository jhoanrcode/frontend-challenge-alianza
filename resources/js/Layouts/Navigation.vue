<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-indigo-700 md:block flex-shrink-0">
    <div class="py-3 bg-slate-100 text-gray-500">
      <Link :href="route('dashboard')">
        <img aria-hidden="true" class="object-cover max-w-36 mx-auto py-px" src="/images/logo-psicoalianza.webp" alt="Logo" />
      </Link>
    </div>
    <div class="py-4 text-white text-base font-semibold">
      <ul class="mt-3">
        <li class="relative px-6 py-3">
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">Home</NavLink>
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
                <NavLink :href="route('empleados.index')" :active="route().current('empleados.index')">Empleados</NavLink>
              </li>
              <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-400">
                <NavLink :href="route('cargos.index')" :active="route().current('cargos.index')">Cargos</NavLink>
              </li>
            </ul>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
  components: {
    NavLink,
    Link,
  },

  setup() {
    let showingTwoLevelMenu = ref(false)

    return {
      showingTwoLevelMenu
    }
  },
}
</script>
