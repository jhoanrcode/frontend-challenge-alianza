<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
	name: '',
	email: '',
	password: '',
	password_confirmation: '',
	terms: false,
});

const submit = () => {
	form.post(route('register'), {
		onFinish: () => form.reset('password', 'password_confirmation'),
	});
};
</script>

<template>
	<GuestLayout>
		<Head title="Registrarse" />
		
		<div class="flex flex-col overflow-y-auto md:flex-row">
			<div class="md:h-auto max-h-screen md:w-1/2 lg:w-2/3">
				<img aria-hidden="true" class="object-cover w-full h-full" src="/images/login.png" alt="Crear cuenta" />
			</div>
			
			<div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2 lg:w-1/3">
				<div class="w-full">
					<img aria-hidden="true" class="object-cover max-w-64 mx-auto" src="/images/logo-psicoalianza-xl.png" alt="Logo" />
					<form @submit.prevent="submit">
						<div class="mt-4 md:mt-8">
							<InputLabel for="name" value="Nombre usuario" />
							<TextInput id="name" type="text" class="block w-full mt-1" v-model="form.name" required autofocus autocomplete="name" />
							<InputError class="mt-2" :message="form.errors.name" />
						</div>
						
						<div class="mt-4">
							<InputLabel for="email" value="Correo electronico" />
							<TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autocomplete="username" />
							<InputError class="mt-2" :message="form.errors.email" />
						</div>
						
						<div class="mt-4">
							<InputLabel for="password" value="Contraseña" />
							<TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required autocomplete="new-password" />
							<InputError class="mt-2" :message="form.errors.password" />
						</div>
						
						<div class="mt-4">
							<InputLabel for="password_confirmation" value="Confirmar Contraseña" />
							<TextInput id="password_confirmation" type="password" class="block w-full mt-1" v-model="form.password_confirmation" required autocomplete="new-password" />
							<InputError class="mt-2" :message="form.errors.password_confirmation" />
						</div>
						
						<div class="flex items-center justify-between mt-4">
							<Link :href="route('login')" class="text-sm text-gray-500 underline hover:text-gray-800">
								¿Ya estas registrado?
							</Link>
							
							<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Crear cuenta
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</GuestLayout>
</template>
