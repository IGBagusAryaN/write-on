@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 text-[#E19B2C] font-semibold bg-[#E19B2C] bg-opacity-10 border-[#E19B2C] text-start text-base font-medium focus:outline-none  transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600  hover:text-[#E19B2C] hover:font-semibold hover:bg-[#E19B2C] hover:bg-opacity-10 hover:border-[#E19B2C] focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
