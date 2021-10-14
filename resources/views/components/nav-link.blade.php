@props(['active'])

@php
$classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 text-lg font-semibold text-white leading-5 hover:text-gray-700 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-lg font-semibold text-white leading-5 hover:text-blue-200 hover:border-blue-200 focus:outline-none focus:text-blue-200 focus:border-blue-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
