@props([
	'formTitle' => 'Formulario de Solicitud',
	'action' => '',
])

<div class="min-h-0 flex flex-col h-full">
	<div class="flex-none">
		<h1 class="text-2xl font-bold text-gray-800 mb-4">Formulario de Solicitud</h1>
			<div class="w-full bg-gray-200 rounded-full h-3.5">
				<div id="progress_bar" class="bg-primary h-3.5 rounded-full text-xs text-center text-white"></div>
			</div>
	</div>
	<div class="flex flex-row min-h-0 flex-1">
		<div class="flex flex-col flex-0 space-x-2">
			<div class="w-full">
				<ul id="indicatorsSection" class="w-full text-lg space-y-2 mt-8">
				</ul>
			</div>
		</div>
		<div class="flex flex-col flex-1 md:flex-4 w-full px-1 min-h-0">
			<form class="flex flex-1 w-full min-h-0" action="{{ $action }}" method="POST" id="registerForm">
				@csrf
				{{$slot}}
			</form>
		</div>
	</div>
			<div class="flex-none w-full flex justify-end p-2 space-x-2">
					<button type="button"
						class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-[#6D1528] "
						id="prevBtn">Regresar</button>
					<button type="button"
						class="px-4 py-2 bg-[#6D1528] text-white rounded-md hover:bg-[#9e2b44] focus:outline-none focus:ring-2 focus:bg-[#9e2b44] "
						id="nextBtn">Continuar</button>
			</div>
	</div>
</div>
