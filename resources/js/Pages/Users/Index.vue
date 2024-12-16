<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
	users: {
		type: Object
	}
})
</script>

<template>
	<Head title="Empleados" />
	
	<AuthenticatedLayout>
		<template #header>
			Empleados
		</template>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-xs">
<!-- 			<div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
				<div class="flex justify-center items-center w-12 bg-blue-500">
					<svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
					</svg>
				</div>
				
				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-blue-500">Info</span>
						<p class="text-sm text-gray-600">Sample table page</p>
					</div>
				</div>
			</div>
			
			<div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
				<div class="overflow-x-auto w-full">
					<table class="w-full whitespace-no-wrap">
						<thead>
							<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
								<th class="px-4 py-3">Name</th>
								<th class="px-4 py-3">Email</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y">
							<tr v-for="user in users.data" :key="user.id" class="text-gray-700">
								<td class="px-4 py-3 text-sm">
									{{ user.name }}
								</td>
								<td class="px-4 py-3 text-sm">
									{{ user.email }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div
					class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
					<pagination :links="users.links" />
				</div>
			</div> -->
			<div class="w-full overflow-x-auto">
				<table class="w-full whitespace-no-wrap">
					<thead>
						<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
							<th class="px-4 py-3">Client</th>
							<th class="px-4 py-3">Amount</th>
							<th class="px-4 py-3">Status</th>
							<th class="px-4 py-3">Date</th>
						</tr>
					</thead>
					<tbody class="divide-y">
						<tr class="text-gray-700">
							<td class="px-4 py-3">
								<div class="flex items-center text-sm">
								<!-- Avatar with inset shadow -->
								<div
									class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
								>
									<img
									class="object-cover w-full h-full rounded-full"
									src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
									alt=""
									loading="lazy"
									/>
									<div
									class="absolute inset-0 rounded-full shadow-inner"
									aria-hidden="true"
									></div>
								</div>
								<div>
									<p class="font-semibold">Hans Burger</p>
									<p class="text-xs text-gray-600 dark:text-gray-400">
									10x Developer
									</p>
								</div>
								</div>
							</td>
							<td class="px-4 py-3 text-sm">
								$ 863.45
							</td>
							<td class="px-4 py-3 text-xs">
								<span
								class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
								>
								Approved
								</span>
							</td>
							<td class="px-4 py-3 text-sm">
								6/10/2020
							</td>
						</tr>
					</tbody>
				</table>
				{{ users }}
				<pagination :links="users.links" />
			</div>
			
		</div>
	</AuthenticatedLayout>
</template>
