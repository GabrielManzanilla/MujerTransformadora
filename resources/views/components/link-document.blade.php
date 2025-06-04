@props(['propietario','tipo_documento', 'titulo', 'status'])

<a class="bg-gray-50 p-2 rounded-lg shadow w-fit flex flex-col justify-between items-center" 
		href="{{ route('archivo.show',['propietario'=>$propietario,'tipo_archivo'=>$tipo_documento]) }}" 
		target="_blank">
	<p class="text-wrap text-center font-semibold">{{$titulo}}</p>
	<svg xmlns="http://www.w3.org/2000/svg" class="h-20 aspect-video" fill="none" viewBox="0 0 24 24"
		stroke="currentColor">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
			d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
	</svg>
	<x-status status="{{$status}}" />
</a>