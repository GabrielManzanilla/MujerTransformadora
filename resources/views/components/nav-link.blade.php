@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm font-bold leading-5 text-secondary focus:outline-secondary focus:border-secondary transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 text-sm font-semibold leading-5 text-white hover:text-secondary focus:outline-none focus:text-secondary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
