<x-app-layout>
	<div class="p-2 md:p-5">
		<div class="absolute bottom-0 right-0 p-2 m-8 bg-primary text-white rounded-full">
			<a href="{{ route('perfil.edit', $user->id) }}">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v2m-4-4l-8 8m0 0l-2 5 5-2 8-8m-8 8L4 16l2-5z" />
				</svg>
			</a>
		</div>
		<div class="w-full flex flex-col justify-center items-center">
			<div class="flex flex-col lg:flex-row justify-around bg-white shadow-md rounded-md w-3/4 p-5">
				<div class="row justify-content-center p-2 px-5">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">Perfil de Usuario</div>

							<div class="card-body">
								<div class="row mb-3">
									<label class="col-md-4 font-bold text-secondary">Nombre:</label>
									<div class="col-md-8">
										{{ $user->name }}
									</div>
								</div>

								<div class="row mb-3">
									<label class="col-md-4 font-bold text-secondary">Email:</label>
									<div class="col-md-8">
										{{ $user->email }}
									</div>
								</div>

								@if($perfil)
									<div class="row mb-3">
										<label class="col-md-4 font-bold text-secondary">Apellido Paterno:</label>
										<div class="col-md-8 ">
											{{ $perfil->str_apellido_paterno ?? 'No especificado' }}
										</div>
									</div>

									<div class="row mb-3">
										<label class="col-md-4 font-bold text-secondary">Apellido Materno:</label>
										<div class="col-md-8 ">
											{{ $perfil->str_apellido_materno ?? 'No especificada' }}
										</div>
									</div>

									<div class="row mb-3">
										<label class="col-md-4 font-bold text-secondary">Fecha de Nacimiento:</label>
										<div class="col-md-8">
											{{ $perfil->dt_fecha_nacimiento ? $perfil->dt_fecha_nacimiento->format('d/m/Y') : 'No especificada' }}
										</div>
									</div>

									<div class="row mb-3">
										<label class="col-md-4 font-bold text-secondary">Lugar de Nacimiento:</label>
										<div class="col-md-8">
											{{ $perfil->str_estado_nacimiento ?? 'No especificada' }},
											{{ $perfil->str_municipio_nacimiento ?? 'No especificado' }}
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				
			</div>

		</div>
</x-app-layout>