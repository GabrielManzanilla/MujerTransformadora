@props([
	'label' => 'Nombre',
	'step' => 1,
	'dinamic_input' => '',
])

<fieldset class="step hidden border border-gray-300 p-1 rounded-lg mb-2 w-full min-h-0 flex-1" data-step="{{ $step }}">
	<legend class="text-lg font-medium px-2">{{$label}}</legend>
	<div class="overflow-y-auto max-h-[60vh]">
		<div class=" grid grid-cols-1 md:grid-cols-2 gap-4 md:px-4">
			{{ $slot}}
		</div>
		<div class="grid grid-cols-1 md:px-4">
			{{ $dinamic_input }}
		</div>
	</div>
</fieldset>