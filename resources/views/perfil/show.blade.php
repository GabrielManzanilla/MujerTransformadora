<x-app-layout>
	<div class="p-2 md:p-5">
		<div class="absolute bottom-0 right-0 p-2 m-8 bg-primary text-white rounded-full">
			<a href="{{ route('perfil.edit', $user->id) }}">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M16 4h2a2 2 0 012 2v2m-4-4l-8 8m0 0l-2 5 5-2 8-8m-8 8L4 16l2-5z" />
				</svg>
			</a>
		</div>
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
						{{ __('Perfil de Usuario') }}
					</h2>
					<div class="flex justify-evenly gap-4">
						<div class="bg-gray-100 p-4 rounded-lg shadow flex-1">
							<h3 class="font-bold text-lg mb-2">Información Personal</h3>
							<p><strong>Nombre:</strong> {{ $user->name }}</p>
							<p><strong>Email:</strong> {{ $user->email }}</p>
							<p><strong>Teléfono:</strong> {{ $user->phone }}</p>
						</div>
						<div>
							Imagen de perfil
						</div>
					</div>
					<div class="bg-gray-100 mt-3 p-4 rounded-lg shadow">
						<h3 class="font-bold text-lg mb-2">Detalles de Nacimiento</h3>
						<p><strong>Fecha de Registro:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
						<p><strong>Última Actualización:</strong> {{ $user->updated_at->format('d/m/Y') }}</p>
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