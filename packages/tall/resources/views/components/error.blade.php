@props(['for'])
@error($for)
    <p {{ $attributes->merge(['class' => 'text-tiny+ text-error']) }}>
        {{ $message }}
    </p>
@enderror