<input
    {{ $attributes->merge([
        'type' => 'checkbox',
        'class' =>
            'form-checkbox is-outline h-5 w-5 rounded border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent',
    ]) }} />
{{ $slot }}
