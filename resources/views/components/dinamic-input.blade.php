@props([
	'headers' => ['nombre', 'RFC', 'acciones'],
	'id_button' => null,
	'id_table' => null,
	'id_message' => null,
	'id_json' => null
	])

<div>
	<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
		{{ $slot }}
	</div>
	<x-primary-button id="{{ $id_button }}" class="mb-4">
		<i class="fas fa-plus"></i> Agregar
	</x-primary-button>
	<table class="min-w-full divide-y divide-gray-200 w-78 md:w-full overflow-x-auto rounded-lg" id="{{$id_table}}">
		<thead class="bg-gray-50">
			<tr>
				@foreach ($headers as $header)
				<th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
					{{$header}}</th>
				@endforeach
				<th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
					Opciones</th>
			</tr>
		</thead>
		<tbody class="bg-white divide-y divide-gray-200">
			<tr id="{{$id_message}}">
				<td colspan="{{ count($headers) + 1 }}" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No hay
					datos disponibles</td>
			</tr>
			<input type="hidden" name="registros_adicionales" id="{{$id_json}}" class="">
	</table>
</div>