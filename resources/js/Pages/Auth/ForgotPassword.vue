<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
	status: {
		type: String,
	},
});

const form = useForm({
	email: '',
});

const submit = () => {
	form.post(route('password.email'));
};
</script>

<template>
	<GuestLayout>
		<Head title="Forgot Password" />
		
		<div class="flex flex-col overflow-y-auto md:flex-row">
			<div class="md:h-auto max-h-screen md:w-1/2 lg:w-2/3">
				<img aria-hidden="true" class="object-cover w-full h-full" src="/images/login.png" alt="Crear cuenta" />
			</div>
			<div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2 lg:w-1/3">
				<div class="w-full">
					<h1 class="mb-4 font-semibold text-gray-700">
						¿Olvidaste tu contraseña? No hay problema. Dejanos tu correo electronico y te enviaremos un link para restablecer tu contraseña.
					</h1>
					
					<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
						{{ status }}
					</div>
					
					<form @submit.prevent="submit">
						<div>
							<InputLabel for="email" value="Correo electronico" />
							<TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus autocomplete="username" />
							<InputError class="mt-2" :message="form.errors.email" />
						</div>
						
						<div class="flex items-center justify-end mt-4">
							<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Restablecer contraseña
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</GuestLayout>
</template>
