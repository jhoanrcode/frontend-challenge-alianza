<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Dashboard" />
	
	<AuthenticatedLayout>
		<div class="container flex flex-col items-center gap-6 px-6 mx-auto text-center text-gray-700">
			<h4 class="text-3xl font-semibold ">Bienvenid@ !</h4>
			<p class="text-xl">{{ $page.props.auth.user.name }}</p>
			<p class="pt-4">De acuerdo con la prueba tecnica propuesta, este pequeño administrador te permitira realizar un CRUD para la gestion de empleados y cargos. <br><b>Recuerda:</b> Añade de primeras los datos personales del empleado y despues asocialo a un cargo. <br><i>(Cada empleado podra ser asociado a un unico cargo).</i></p>
			<p class="pt-4">Mas información del proyecto: <a :href="route('about')" class="text-indigo-600">About me</a></p>
			<p class="pt-4"><small><i>Desarrollado por Jhoan Avila / joria94@hotmail.com / <a href="https://github.com/jhoanrcode" class="text-indigo-600" target="_blank">@jhoanrcode</a></i></small></p>
		</div>
		
	</AuthenticatedLayout>
</template>
