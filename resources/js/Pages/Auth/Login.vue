<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
	email: '',
	password: '',
	remember: false
});

const submit = () => {
	form.post(route('login'), {
		onFinish: () => form.reset('password'),
	});
};
</script>

<template>
	<GuestLayout>
		<Head title="Inicio de sesion" />
		
		<div class="flex flex-col overflow-y-auto md:flex-row">
			<div class="md:h-auto max-h-screen md:w-1/2 lg:w-2/3">
				<img aria-hidden="true" class="object-cover w-full h-full" src="/images/login.png" alt="Office" />
			</div>
			<div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2 lg:w-1/3">
				<div class="w-full">
					<img aria-hidden="true" class="object-cover max-w-64 mx-auto mb-4" src="/images/logo-psicoalianza-xl.png" alt="Logo" />
					<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
						{{ status }}
					</div>
					
					<form @submit.prevent="submit">
						<div class="mt-4 md:mt-8">
							<InputLabel for="email" value="Correo electronico" />
							<TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus autocomplete="username" />
							<InputError class="mt-2" :message="form.errors.email" />
						</div>
						
						<div class="mt-4">
							<InputLabel for="password" value="Contraseña" />
							<TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required autocomplete="current-password" />
							<InputError class="mt-2" :message="form.errors.password" />
						</div>
						
						<div class="block mt-4">
							<label class="flex items-center">
								<Checkbox name="remember" v-model:checked="form.remember" />
								<span class="ml-2 text-sm text-gray-600">Recordar mis datos</span> </label>
						</div>
						
						<div class="flex items-center justify-between mt-4">
							<div>
								<p><Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-500 underline hover:text-gray-800">
										¿Olvidaste tu contraseña?
								</Link></p>
								<p><Link :href="route('register')" class="text-sm text-gray-500 underline hover:text-gray-800">
									Crear cuenta
								</Link></p>
							</div>
							
							
							<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Iniciar sesión
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</GuestLayout>
</template>
