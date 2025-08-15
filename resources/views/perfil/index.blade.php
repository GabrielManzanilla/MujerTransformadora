<x-app-layout>
	<div class="flex-1 overflow-auto h-full">
		<x-table title="Usuarios" :headers="['Nombre', 'Email', 'Rol', 'Telefono' ]"
		:items="['perfil.str_nombre', 'email', 'role', 'perfil.str_telefono']"
		:data="$users"
		>

		</x-table>
		@php
		foreach($users as $user){
			$userData[] = array(
				'apellido_paterno' => $user->perfil->str_apellido_paterno
			);
			print_r($userData);
		}
		@endphp
	</div>
</x-app-layout>