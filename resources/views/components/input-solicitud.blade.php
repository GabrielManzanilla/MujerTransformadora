@props([
		'id' => '',
		'name' =>'',
		'label' => '',
		'type' => 'text',
		'options' => [],
		'class' => '',
])

@php


@endphp

<div class="flex flex-col space-y-2 {{ $class }}">
	<label for="name" class="text-sm font-medium">{{$label}}</label>
	@if ($type === 'select')
	<select id="{{$id}}" name="{{$name}}" class="border border-gray-300 rounded p-2 w-full" required>
		@foreach ($options as $value => $text)
			<option value="{{ $text }}">{{ $text }}</option>
		@endforeach
	</select>
	@else
	<input type="{{ $type }}" id="{{$id}}" name="{{ $name }}" class="border border-gray-300 rounded p-2 w-full" required>
	@endif
</div>