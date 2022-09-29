@props(['name', 'style' => 'outline'])
<x-dynamic-component component="tall-icons.{{ $style }}.{{ $name }}"
    {{ $attributes->merge([
        'class' => 'h-5 w-5 transition-colors duration-200',
    ]) }} />
