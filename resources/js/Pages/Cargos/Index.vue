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
		cargos: {
			type: Object
		},
		empleados: {
			type: Object
		},
	})

	const { cargos, empleados } = toRefs(props);
	const search = ref("");
	const operationCrudCargo = ref("");
	const stateShowModalDeleteCargo = ref(false);
	const listCargos = ref([
		{ "group":"Marketing", "options":[{ text: 'Analista de datos', value: 'Analista de datos - Antioquia' }, { text: 'Diseñador grafico', value: 'Diseñador grafico - Antioquia' }, { text: 'Comunicador social', value: 'Comunicador social - Antioquia' }] },
		{ "group":"Logistica", "options":[{ text: 'Transportador', value: 'Transportador - Logistica' } ] },
		{ "group":"Administrativo", "options":[{ text: 'Contador', value: 'Contador - Administrativo' }, { text: 'RRHH', value: 'RRHH - Administrativo' }] },
		{ "group":"Informatica", "options":[{ text: 'Dev Frontend', value: 'Dev Frontend - Informatica' }, { text: 'Dev Backend', value: 'Dev Backend - Informatica' }, { text: 'Analista QA', value: 'Analista QA - Informatica' }, { text: 'Administrador BD', value: 'Administrador BD - Informatica' }] },
	]);

	const optionsModal = reactive({
        stateShow: false,
        title: '',
        message: '',
		hiddenMessage: true
    });
	const form = useForm({
		id: 0,
		id_empleados: 0,
		cargo: '',
		jefe: '',
	});

	const searchedCargos = computed( () => { //Filtro buscar en tabla
    	return ( (cargos.value).data).filter( (cargo) => {
			const name = cargo.nombre.toLowerCase();
			const job = cargo.cargo.toLowerCase();
			const boss = cargo.jefe.toLowerCase();
			const searchTerm = search.value.toLowerCase();
			return ( name.includes(searchTerm) || job.includes(searchTerm) || boss.includes(searchTerm) );
      	});
    });

	const showModalEditCargo = ( option, data={} ) => { //Desplegar modal add/edit cargo
		if (option == "create") { //Crear empleado
			optionsModal.title = "Agregar cargo a empleado";
		} else { //Editar empleado
			optionsModal.title = "Editar cargo a empleado";
			form.id_empleados = data.id_empleados;
			form.cargo = data.cargo;
			form.jefe = data.jefe;
			form.id = data.id;
		}
		operationCrudCargo.value = option;
		optionsModal.stateShow = true;
	}

	const closeModalEditCargo = () => { //Cerrar modal add/edit cargo
		optionsModal.stateShow = false;
		form.reset();
		form.clearErrors();
	};

	const showModalDeleteCargo = ( idCargo ) => { //Desplegar modal delete cargo
		form.id = idCargo;
		stateShowModalDeleteCargo.value = true;
	}

	const closeModalDeleteCargo = () => { //Cerrar modal delete cargo
		stateShowModalDeleteCargo.value = false;
	};

	const saveCargo = () => {
		if (operationCrudCargo.value == "create") {
			form.post(route('cargos.store'), {
				onSuccess: () => successAction("agregado")
			});
		} else {
			form.put(route('cargos.update', form.id), {
				onSuccess: () => successAction("actualizado")
			});
		}
	} 

	const deleteCargo = () => {
		form.delete(route('cargos.destroy', form.id), {
			onSuccess: () => successAction("eliminado")
		});
	} 

	const successAction = (action) => {
		optionsModal.message = `Cargo de empleado ${action} exitosamente.`;
		optionsModal.hiddenMessage = false;
		setTimeout(() => { optionsModal.hiddenMessage = true; }, 2500);
		closeModalEditCargo();
		closeModalDeleteCargo();
	}
</script>

<template>
	<Head title="Cargos" />
	
	<AuthenticatedLayout>
		<template #header>
			Cargos
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
				<PrimaryButton class="ring-transparent" @click="showModalEditCargo('create')">Agregar</PrimaryButton>
			</div>
		</div>

		<!-- Table information -->
		<div class="w-full overflow-hidden rounded-lg border shadow-xs">
			<div class="w-full overflow-x-auto">
				<table class="w-full whitespace-no-wrap text-center">
					<thead>
						<tr class="text-xs font-semibold tracking-wide text-gray-600 uppercase border-b bg-gray-50">
							<th class="px-4 py-3">Nombre de empleado</th>
							<th class="px-4 py-3">Cargo</th>
							<th class="px-4 py-3">Jefe</th>
							<th class="px-4 py-3">Acciones</th>
						</tr>
					</thead>
					<tbody class="divide-y text-sm" v-if="(searchedCargos).length > 0">
						<tr class="text-gray-700" v-for="cargo in searchedCargos" :key="cargo.id" >
							<td class="px-4 py-3">{{ cargo.nombre }}</td>
							<td class="px-4 py-3">{{ cargo.cargo }}</td>
							<td class="px-4 py-3">{{ cargo.jefe }}</td>
							<td class="px-4 py-3">
								<div class="flex items-center justify-center mx-auto gap-2">
									<button class="flex items-center justify-between p-2 font-medium leading-5 text-indigo-600 rounded-lg hover:text-indigo-500 focus:outline-none focus:shadow-outline-gray" @click="showModalEditCargo('edit',cargo)" title="Editar" aria-label="Editar">
										<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
											<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
										</svg>
									</button>
									<button class="flex items-center justify-between p-2 font-medium leading-5 text-indigo-600 rounded-lg hover:text-indigo-500 focus:outline-none focus:shadow-outline-gray" @click="showModalDeleteCargo(cargo.id)" title="Eliminar" aria-label="Eliminar">
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
							<td  colspan="4" class="px-4 py-3">No se encontraron cargos.</td>
						</tr>
					</tbody>
				</table>
            </div>
		</div>
		<div class="mt-3">
			<pagination :links="cargos.links" />
		</div>

		<!-- Modal add/edit cargos -->
		<Modal :show="optionsModal.stateShow" @close="closeModalEditCargo">
			<div class="p-6 text-gray-700">
				<header class="flex items-center justify-between">
					<h2 class="text-lg font-semibold">{{optionsModal.title}}</h2>
					<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover:text-gray-700" aria-label="close" @click="closeModalEditCargo">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
							<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
						</svg>
					</button>
				</header>

				<form @submit.prevent="saveCargo" class="text-sm text-gray-600">
					<div class="mt-4">
						<InputLabel for="id_empleados" value="Empleado" />
						<SelectedGroup id="id_empleados" class="block w-full mt-1" :listOptions="empleados" v-model="form.id_empleados" required />
						<InputError class="mt-2" :message="form.errors.id_empleados" />
					</div>
					
					<div class="mt-4">
						<InputLabel for="cargo" value="Cargo" />
						<SelectedGroup id="cargo" class="block w-full mt-1" :listOptions="listCargos" v-model="form.cargo" required />
						<InputError class="mt-2" :message="form.errors.cargo" />
					</div>
					
					<div class="mt-4">
						<InputLabel for="jefe" value="Jefe Inmediato" />
						<TextInput id="jefe" type="text" class="block w-full mt-1" v-model="form.jefe" required autocomplete="off" maxlength="200" />
						<InputError class="mt-2" :message="form.errors.jefe" />
					</div>

					<footer class="flex items-center justify-center gap-4 mt-4">
						<SecondaryButton @click="closeModalEditCargo">Cancelar</SecondaryButton>
						<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Guardar</PrimaryButton>
					</footer>
				</form>
			</div>
		</Modal>

		<!-- Modal delete cargos -->
		<Modal :show="stateShowModalDeleteCargo" @close="closeModalDeleteCargo">
			<div class="p-6 text-gray-700">
				<header class="flex items-center justify-between">
					<h2 class="text-lg font-semibold">Eliminar cargo de empleado</h2>
					<button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover:text-gray-700" aria-label="close" @click="closeModalDeleteCargo">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
							<path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
						</svg>
					</button>
				</header>
				<div class="flex flex-col items-center justify-center mt-4">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
					</svg>
					<p class="mt-2 text-sm text-gray-600 text-center">¿Estas seguro de querer borrar este cargo de empleado?</p>
				</div>
				<footer class="flex items-center justify-center gap-4 mt-4">
					<SecondaryButton @click="closeModalDeleteCargo">Cancelar</SecondaryButton>
					<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="deleteCargo">Eliminar</PrimaryButton>
				</footer>
			</div>
		</Modal>

	</AuthenticatedLayout>
</template>
