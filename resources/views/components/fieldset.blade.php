@props([
		'label' => 'Nombre',
		'step' => 1,
		'dinamic_input' => '',
])

<fieldset class="step hidden border border-gray-300 p-4 rounded-lg mb-4 overflow-x-hidden w-full" data-step="{{ $step }}">
	<legend class="text-lg font-medium px-2">{{$label}}</legend>
	<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
		{{ $slot}}
	</div>
	<div>
		{{ $dinamic_input }}
	</div>
	
</fieldset>