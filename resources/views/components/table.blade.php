 <!-- Este componente recibe como props el titulo de la tabla, los encabezados, los items (el nombre que tienen en la db) y los datos a mostrar (el contenido de una fila) . -->

@props(['title' => '', 
        'headers' => [], 
        'items' => [], 
        'data' => []])


<div class="container mx-auto px-4 py-6 ">

    <div class="flex uppercase text-lg font-black px-3 mb-5">
    <p>{{ $title }}</p>
    
    @if (auth()->user()->role === 'user')
        <x-primary-button class="ml-auto" 
                        onclick="window.location.href='{{ route('solicitud.create') }}'">
            Crear Solicitud
            
            <svg class="w-4 h-4 inline-block ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
        </x-primary-button>
    @endif
    </div>
    <div class=" overflow-x-auto shadow-md sm:rounded-lg ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="px-6 py-3 font-semibold"">
                        {{$header}}
                    </th>
                @endforeach
                <th scope="col" class="px-6 py-3 text-right">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Status
                    </th>
                    @foreach ($items as $field)
                        <td class="px-6 py-4">
                            {{ $item[$field] ?? 'N/A' }}
                        </td>
                    @endforeach
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-secondary hover:underline">Edit</a>
                    </td>
                </tr>
      @endforeach
        </tbody>
    </table>
</div>
</div>