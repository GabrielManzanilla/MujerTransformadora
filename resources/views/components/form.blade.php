@props([
	'formTitle' => 'Formulario de Solicitud',
])

<div class="h-full flex flex-col">
	<div>
	<h1 class="text-2xl font-bold text-gray-800 mb-4">Formulario de Solicitud</h1>
		<div class="w-full bg-gray-200 rounded-full h-2.5">
  		<div id="progress_bar" class="bg-primary h-2.5 rounded-full text-xs text-center text-white"></div>
		</div>
	</div>
	<div class="flex flex-row h-full">
		<div class="flex flex-col flex-0 space-x-2">
			<div class="w-full">
				<ul id="indicatorsSection" class="w-full text-lg space-y-2 mt-8">
				</ul>
			</div>
		</div>
		<div class="flex flex-col flex-1 md:flex-4 h-full w-full px-1">
			<form class="flex flex-1 w-full overflow-auto" action="">
				@csrf
				{{$slot}}
			</form>
			<div class="flex-0 w-full flex justify-end p-2 space-x-2">
					<button id="prevBtn">Anterior</button>
					<button id="nextBtn">Siguiente</button>
			</div>
	</div>
</div>