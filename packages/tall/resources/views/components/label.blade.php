@props(['label' => null])
<label {{ $attributes }}>
    {{ $label ?? $slot }}
</label>
