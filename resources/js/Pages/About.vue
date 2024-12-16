<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
	<Head title="About me" />
	
	<AuthenticatedLayout>
		<div class="text-gray-700 text-center">
			<h4 class="text-3xl font-semibold mb-8">About me</h4>
			<ul>
				<li>👨🏻‍💻 <b>Autor:</b> Jhoan Avila Gutierrez</li>
				<li>⚙️ <b>Code:</b> Vite + Vue 3 + JavaScript + Inertia<br>PHP + Laravel 11 <br> MySQL</li>
				<li>📱 <b>Telefono:</b> 3203645490</li>
				<li>📧 <b>Email:</b> <a href="mailto:joria94@hotmail.com" class="text-indigo-600">joria94@hotmail.com</a></li>
				<li>🛠️ <b>Github:</b> 
					<a href="https://github.com/jhoanrcode/frontend-challenge-alianza" class="text-indigo-600" target="_blank"> Repositorio Proyecto</a>
				</li>
			</ul>
		</div>
	</AuthenticatedLayout>
</template>
