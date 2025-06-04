@props(['id'=>null, 'accept'=>'*/*'])

<input type="file" class="file:mr-4 file:rounded-full file:border-0 file:bg-secondary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-white hover:file:text-secondary hover:file:ring-2 hover:file:ring-secondary p-2" 
id="{{ $id }}" name="{{ $id }}"
accept="{{ $accept }}"/>