<x-app-layout>
	<div class="p-2 md:p-5">
		<div class="absolute bottom-0 right-0 p-2 m-8 bg-primary text-white rounded-full">
			@if (auth()->user()->role === 'admin')
				<a href="">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 8v4m0 0v4m0-4h4m-4 0H8m12 4a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v10z" />
					</svg>
				</a>
			@else
				<a href="{{ route('perfil.edit', $user->id) }}">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M16 4h2a2 2 0 012 2v2m-4-4l-8 8m0 0l-2 5 5-2 8-8m-8 8L4 16l2-5z" />
					</svg>
				</a>
			@endif
		</div>
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<div class="flex flex-row gap-2 items-center mb-4">
						<div class="flex bg-gray-100 p-1 rounded-lg shadow items-center gap-2">
							<span class="rounded-full h-2 w-2 bg-green-300"></span>
							<p class="font-bold">Status</p>
						</div>
						<h2 class="font-semibold text-xl text-gray-800 leading-tight ">
							{{ __('Perfil de Usuario') }}
						</h2>
					</div>
					<div class="flex flex-col-reverse md:flex-row justify-evenly gap-4">
						<div class="bg-gray-100 p-4 rounded-lg shadow flex-1">
							<h3 class="font-bold text-lg mb-2">Información Personal</h3>
							<p><strong>Nombre(s):</strong> {{ $user->perfil->str_nombre }}</p>
							<p><strong>Apellido Paterno:</strong> {{ $user->perfil->str_apellido_paterno }}</p>
							<p><strong>Apellido Materno:</strong> {{ $user->perfil->str_apellido_materno }}</p>
							<p><strong>{{ $user->perfil->str_sexo }}
									{{ ($user->perfil->bool_es_mayahablante === 1) && '| MayaHablante'}}</strong></p>
							<p><strong>Email:</strong> {{ $user->email }}</p>
							<p><strong>Teléfono:</strong> {{ $user->perfil->str_telefono }}</p>
						</div>
						<div class="bg-gray-100 p-4 rounded-lg shadow flex-0 flex-col flex justify-center items-center">
							<a href="{{ route('archivo.show',['propietario'=>'perfil','tipo_archivo'=>'foto_perfil']) }}" target="_blank">
								<img src="{{ route('archivo.show',['propietario'=>'perfil','tipo_archivo'=>'foto_perfil'])}}" alt="imagen de perfil"
								class="w-auto h-48 object-cover aspect-square rounded-lg">
							</a>
						</div>
					</div>
					<div class="bg-gray-100 mt-3 p-4 rounded-lg shadow">
						<h3 class="font-bold text-lg mb-2">Detalles de Nacimiento</h3>
						<p><strong>Fecha de Nacimiento:</strong> {{ $user->perfil->dt_fecha_nacimiento->format('d/m/Y') }}</p>
						<p><strong>Estado de Nacimiento:</strong> {{ $user->perfil->str_estado_nacimiento }}</p>
						<p><strong>Municipio de Nacimiento:</strong> {{ $user->perfil->str_municipio_nacimiento }}</p>
					</div>

					<div class="bg-gray-100 mt-3 p-4 rounded-lg shadow overflow-x-auto">
						<h3 class="font-bold text-lg mb-2">Documentos</h3>
						<div class="flex flex-row gap-2">
							<div class="bg-gray-50 p-2 rounded-lg shadow max-w-28 flex flex-col justify-between items-center">
								<p class="text-wrap text-center font-semibold">Acta Nacimiento</p>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-20 aspect-video" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
								</svg>
								<div class="text-sm flex flex-row items-center gap-2">
									<div class="w-2 h-2 bg-green-400 rounded-full "></div>
									Status
								</div>
							</div>

							<div class="bg-gray-50 p-2 rounded-lg shadow max-w-28 flex flex-col justify-between items-center">
								<p class="text-wrap text-center font-semibold"><br>INE</p>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-20 aspect-video" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
								</svg>
								<div class="text-sm flex flex-row items-center gap-2">
									<div class="w-2 h-2 bg-green-400 rounded-full "></div>
									Status
								</div>
							</div>

							<div class="bg-gray-50 p-2 rounded-lg shadow max-w-28 flex flex-col justify-between items-center">
								<p class="text-wrap text-center font-semibold">Comprobante Domicilio</p>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-20 aspect-video" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
								</svg>
								<div class="text-sm flex flex-row items-center gap-2">
									<div class="w-2 h-2 bg-green-400 rounded-full "></div>
									Status
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</x-app-layout>