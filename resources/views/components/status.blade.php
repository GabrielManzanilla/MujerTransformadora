@props(['status' => null])
@php 

	$statusClass = match ($status) {
		'Activo' => 'bg-green-300',
		'Inactivo' => 'bg-red-300',
		'En Revision' => 'bg-yellow-300',
		'Necesita Actualizacion' => 'bg-orange-300',
		default => 'bg-gray-300',
	};
@endphp

<div class="flex bg-gray-100 p-1 rounded-lg shadow items-center gap-2">
	<span class="rounded-full h-2 w-2 {{ $statusClass }}"></span>
	<p class="font-bold">{{ $status }}</p>
</div>