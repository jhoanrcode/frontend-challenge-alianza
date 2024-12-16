<script setup>
    import { reactive, computed , toRefs, ref } from 'vue';
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import PrimaryButton from '@/Components/PrimaryButton.vue';
	import SecondaryButton from '@/Components/SecondaryButton.vue';
	import Modal from '@/Components/Modal.vue';
	import InputError from '@/Components/InputError.vue';
	import InputLabel from '@/Components/InputLabel.vue';
	import TextInput from '@/Components/TextInput.vue';
	import SelectedGroup from '@/Components/SelectedGroup.vue';
	import Pagination from '@/Components/Pagination.vue';
	import { Head, useForm } from '@inertiajs/vue3';

	const props = defineProps({
		empleados: {
			type: Object
		}
	})

	const { empleados } = toRefs(props);
	const search = ref("");
	const operationCrudEmpleado = ref("");
	const stateShowModalDeleteEmpleado = ref(false);
	const listCities = ref([
		{ "group":"Antioquia", "options":[{ text: 'Medellin', value: 'Medellin - Antioquia' }, { text: 'Bello', value: 'Bello - Antioquia' }, { text: 'Envigado', value: 'Envigado - Antioquia' }] },
		{ "group":"Atlantico", "options":[{ text: 'Barranquilla', value: 'Barranquilla - Atlantico' } ] },
		{ "group":"Bolivar", "options":[{ text: 'Cartagena', value: 'Cartagena - Bolivar' } ] },
		{ "group":"Boyaca", "options":[{ text: 'Tunja', value: 'Tunja - Boyaca' }, { text: 'Villa de Leyva', value: 'Villa de Leyva - Boyaca' }] },
		{ "group":"Cundinamarca", "options":[{ text: 'Bogota D.C', value: 'Bogota D.C - Cundinamarca' }, { text: 'Fusagasuga', value: 'Fusagasuga - Cundinamarca' }, { text: 'Facatativa', value: 'Facatativa - Cundinamarca' }, { text: 'Zipaquira', value: 'Zipaquira - Cundinamarca' }] },
	]);

	const optionsModal = reactive({
        stateShow: false,
        title: '',
        message: '',
		hiddenMessage: true
    });
	const form = useForm({
		id: 0,
		nombre: '',
		identificacion: '',
		direccion: '',
		telefono: '',
		ciudad: '',
	});

	const searchedEmpleados = computed( () => { //Filtro buscar en tabla
    	return ( (empleados.value).data).filter( (empleado) => {
			const name = empleado.nombre.toLowerCase();
			const address = empleado.direccion.toLowerCase();
			const tel = empleado.telefono.toLowerCase();
			const city = empleado.ciudad.toLowerCase();
			const searchTerm = search.value.toLowerCase();
			return ( name.includes(searchTerm) || address.includes(searchTerm) || tel.includes(searchTerm) || city.includes(searchTerm) );
      	});
    });

	const showModalEditEmpleado = ( option, data={} ) => { //Desplegar modal add/edit empleado
		if (option == "create") { //Crear empleado
			optionsModal.title = "Agregar empleado";
		} else { //Editar empleado
			optionsModal.title = "Editar empleado";
			form.nombre = data.nombre;
			form.identificacion = data.identificacion;
			form.direccion = data.direccion;
			form.telefono = data.telefono;
			form.ciudad = data.ciudad;
			form.id = data.id;
		}
		operationCrudEmpleado.value = option;
		optionsModal.stateShow = true;
	}

	const closeModalEditEmpleado = () => { //Cerrar modal add/edit empleado
		optionsModal.stateShow = false;
		form.reset();
		form.clearErrors();
	};

	const showModalDeleteEmpleado = ( idEmpleado ) => { //Desplegar modal delete empleado
		form.id = idEmpleado;
		stateShowModalDeleteEmpleado.value = true;
	}

	const closeModalDeleteEmpleado = () => { //Cerrar modal delete empleado
		stateShowModalDeleteEmpleado.value = false;
	};

	const saveEmpleado = () => {
		if (operationCrudEmpleado.value == "create") {
			form.post(route('empleados.store'), {
				onSuccess: () => successAction("agregado")
			});
		} else {
			form.put(route('empleados.update', form.id), {
				onSuccess: () => successAction("actualizado")
			});
		}
	} 

	const deleteEmpleado = () => {
		form.delete(route('empleados.destroy', form.id), {
			onSuccess: () => successAction("eliminado")
		});
	} 

	const successAction = (action) => {
		optionsModal.message = `Empleado ${action} exitosamente.`;
		optionsModal.hiddenMessage = false;
		setTimeout(() => { optionsModal.hiddenMessage = true; }, 2500);
		closeModalEditEmpleado();
		closeModalDeleteEmpleado();
	}

</script>

<template>
	<Head title="Empleados" />
	
	<AuthenticatedLayout>
		<template #header>
			Empleados
		</template>

		<!-- Messagge action -->
		<span class="p-2 mb-4 font-semibold text-sm text-green-700 bg-green-100 rounded-full text-center" :class="{ 'hidden': optionsModal.hiddenMessage }">
			{{ optionsModal.message }}
		</span>

		<!-- Options filter table -->
		<div class="flex items-center justify-between mb-4 text-gray-700 gap-4">
			<div class="relative w-full max-w-xl focus-within:text-indigo-600">
				<div class="absolute inset-y-0 flex items-center pl-4">
					<svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
					</svg>
				</div>
				<input class="w-full pl-10 pr-4 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-0 rounded-md focus:border-indigo-400 focus:outline-none focus:ring-indigo-400" type="text" placeholder="Buscar" aria-label="Buscar" v-model="search">
			</div>
			<div class="">
				<PrimaryButton class="ring-transparent" @click="showModalEditEmpleado('create')">Agregar</PrimaryButton>
			</div>
		</div>
		
		<!-- Table information -->
		<div class="w-full overflow-hidden rounded-lg border shadow-xs">
			<div class="w-full overflow-x-auto">
				<table class="w-full whitespace-no-wrap text-center">
					<thead>
						<tr class="text-xs font-semibold tracking-wide text-gray-600 uppercase border-b bg-gray-50">
							<th class="px-4 py-3">Nombre</th>
							<th class="px-4 py-3">Identificación</th>
							<th class="px-4 py-3">Dirección</th>
							<th class="px-4 py-3">Telefono</th>
							<th class="px-4 py-3">Ciudad</th>
							<th class="px-4 py-3">Acciones</th>
						</tr>
					</thead>
					<tbody class="divide-y text-sm" v-if="(searchedEmpleados).length > 0">
						<tr class="text-gray-700" v-for="(empleado,i) in searchedEmpleados" :key="empleado.id" >
							<td class="px-4 py-3">{{ empleado.nombre }}</td>
							<td class="px-4 py-3">{{ empleado.identificacion }}</td>
							<td class="px-4 py-3">{{ empleado.direccion }}</td>
							<td class="px-4 py-3">{{ empleado.telefono }}</td>
							<td class="px-4 py-3">{{ empleado.ciudad }}</td>
							<td class="px-4 py-3">
								<div class="flex items-center justify-center mx-auto gap-2">
									<button class="flex items-center justify-between p-2 font-medium leading-5 text-indigo-600 rounded-lg hover:text-indigo-500 focus:outline-none focus:shadow-outline-gray" @click="showModalEditEmpleado('edit',empleado)" title="Editar" aria-label="Editar">
										<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
											<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
										</svg>
									</button>
									<button class="flex items-center justify-between p-2 font-medium leading-5 text-indigo-600 rounded-lg hover:text-indigo-500 focus:outline-none focus:shadow-outline-gray" @click="showModalDeleteEmpleado(empleado.id)" title="Eliminar" aria-label="Eliminar">
										<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
										</svg>
									</button>
								</div>
							</td>
						</tr>
					</tbody>
					<tbody class="divide-y text-sm" v-else>
						<tr class="text-gray-700">
							<td  colspan="6" class="px-4 py-3">No se encontraron empleados.</td>
						</tr>
					</tbody>
				</table>
            </div>
		</div>
		<div class="mt-3">
			<pagination :links="empleados.links" />
		</div>

		<!-- Modal add/edit empleados -->
		<Modal :show="optionsModal.stateShow" @close="closeModalEditEmpleado">
            <div class="p-6 text-gray-700">
				<header class="flex items-center justify-between">
					<h2 class="text-lg font-semibold">{{optionsModal.title}}</h2>
					<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover:text-gray-700" aria-label="close" @click="closeModalEditEmpleado">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
							<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
						</svg>
					</button>
				</header>

				<form @submit.prevent="saveEmpleado" class="text-sm text-gray-600">
					<div class="mt-4">
						<InputLabel for="nombre" value="Nombre completo" />
						<TextInput id="nombre" type="text" class="block w-full mt-1" v-model="form.nombre" required autocomplete="off" maxlength="200" />
						<InputError class="mt-2" :message="form.errors.nombre" />
					</div>
					
					<div class="mt-4">
						<InputLabel for="identificacion" value="Identificación" />
						<TextInput id="identificacion" type="number" class="block w-full mt-1" v-model="form.identificacion" required autocomplete="off" min="10000" max="9999999999" />
						<InputError class="mt-2" :message="form.errors.identificacion" />
					</div>
					
					<div class="mt-4">
						<InputLabel for="direccion" value="Dirección" />
						<TextInput id="direccion" type="text" class="block w-full mt-1" v-model="form.direccion" required autocomplete="off" maxlength="200" />
						<InputError class="mt-2" :message="form.errors.direccion" />
					</div>
					
					<div class="mt-4">
						<InputLabel for="telefono" value="Telefono" />
						<TextInput id="telefono" type="number" class="block w-full mt-1" v-model="form.telefono" required autocomplete="off" min="10000" max="9999999999" />
						<InputError class="mt-2" :message="form.errors.telefono" />
					</div>
					
					<div class="mt-4">
						<InputLabel for="ciudad" value="Ciudad" />
						<SelectedGroup id="ciudad" class="block w-full mt-1" :listOptions="listCities" v-model="form.ciudad" required />
						<InputError class="mt-2" :message="form.errors.ciudad" />
					</div>

					<footer class="flex items-center justify-center gap-4 mt-4">
						<SecondaryButton @click="closeModalEditEmpleado">Cancelar</SecondaryButton>
						<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Guardar</PrimaryButton>
					</footer>
				</form>
            </div>
        </Modal>

		<!-- Modal delete empleados -->
		<Modal :show="stateShowModalDeleteEmpleado" @close="closeModalDeleteEmpleado">
            <div class="p-6 text-gray-700">
				<header class="flex items-center justify-between">
					<h2 class="text-lg font-semibold">Eliminar empleado</h2>
					<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover:text-gray-700" aria-label="close" @click="closeModalDeleteEmpleado">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
							<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
						</svg>
					</button>
				</header>
				<div class="flex flex-col items-center justify-center mt-4">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
					</svg>
					<p class="mt-2 text-sm text-gray-600 text-center">¿Estas seguro de querer borrar este empleado?</p>
				</div>
				<footer class="flex items-center justify-center gap-4 mt-4">
					<SecondaryButton @click="closeModalDeleteEmpleado">Cancelar</SecondaryButton>
					<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="deleteEmpleado">Eliminar</PrimaryButton>
				</footer>
            </div>
        </Modal>

	</AuthenticatedLayout>
</template>
