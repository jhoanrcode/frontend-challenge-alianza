<template>
<!--   <div v-if="links.length > 3">
    <div class="-mb-1 flex flex-wrap">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mr-1 mb-1 rounded border px-2 py-1 text-sm leading-4 text-gray-400" v-html="link.label" />
        <Link v-else :key="key + 1" class="mr-1 mb-1 rounded border px-2 py-1 text-sm leading-4 hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'text-white bg-purple-600 hover:bg-purple-600': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div> -->
  <div v-if="links.length > 3" class="flex mt-2 justify-center text-sm text-indigo-600 font-semibold">
    <nav aria-label="Table navigation">
      <ul class="inline-flex items-center gap-2">
        <li v-for="(link, key) in links" :key="key" v-html="typeBtnPagination(link)" ></li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
  import { Link } from "@inertiajs/vue3";

  defineProps({
    links: Array,
  });

  function typeBtnPagination( link ) {
      if ( link.label.includes('Previous') || link.label.includes('Next') ) {
        const classBtn = (link.url === null) ? 'cursor-not-allowed text-gray-400' : 'hover:text-indigo-500' ;
        const hrefBtn = (link.url === null) ? '' : `href="${link.url}"` ;

        if ( link.label.includes('Previous') ) {
          return  `<a ${hrefBtn} class="px-3 py-2 ${classBtn}" title="Atras" aria-label="Atras">
            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
              <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
          </a>`;
        } else {
          return `<a ${hrefBtn} class="px-3 py-2 ${classBtn}" title="Siguiente" aria-label="Siguiente">
            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
              <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
          </a>`;
        }
      } else {
        const classBtnActive = (link.active) ? 'text-white transition-colors duration-150 bg-indigo-400 border border-r-0 border-indigo-400 rounded-md hover:text-white' : 'hover:text-indigo-500';
        return `<a href="${link.url}" class="px-3 py-2 ${classBtnActive}" >${link.label}</a>`;
      }
  }
</script>