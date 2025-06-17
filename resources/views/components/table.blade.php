<!-- Este componente recibe como props el titulo de la tabla, los encabezados, los items (el nombre que tienen en la db) y los datos a mostrar (el contenido de una fila) . -->

@props([
    'title' => '',
    'headers' => [],
    'items' => [],
    'data' => [],
    'actions' => false,
    'show_route',
    'edit_route',
    'param'
])

<div class="container mx-auto px-4 py-6">
    <div class="flex uppercase text-lg font-black px-3 mb-5">
        <p>{{ $title }}</p>
        @if (auth()->user()->role === 'user' && request()->routeIs('solicitud.index'))
            <x-primary-button class="ml-auto" onclick="window.location.href='{{ route('solicitud.create') }}'">
                Crear Solicitud
                <svg class="w-4 h-4 inline-block ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            </x-primary-button>
        @endif
    </div>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    @foreach ($headers as $header)
                        <th scope="col" class="px-6 py-3 font-semibold">
                            {{ $header }}
                        </th>
                    @endforeach
                    @if ($actions)
                        <th scope="col" class="px-6 py-3 font-semibold text-center">
                            Actions
                        </th>
                    
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50"
                        @if(isset($route) && isset($param) && $route && $param)
                            onclick="window.location.href='{{ route($show_route, $item[$param]) }}'"
                        @endif
                    >
                        @foreach ($items as $field)
                            @if ($field === 'str_status')
                                <td class="px-6 py-4">
                                    <x-status :status="$item[$field]" />
                                </td>
                            @elseif ($item[$field])
                                <td class="px-6 py-4">
                                    {{ $item[$field] }}
                                </td>
                            @endif
                        @endforeach
                        @if ($actions)
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route($edit_route, $item[$param]) }}" class="font-medium text-secondary hover:underline">Edit</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>