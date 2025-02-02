@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 text-sm leading-5 border-b-2 border-indigo-400 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition'
            : 'block px-4 py-2 text-sm leading-5 text-gray-700 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:bg-gray-100 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
 