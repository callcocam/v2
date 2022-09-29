<label class="inline-flex items-center">
    <input value="{{ data_get($model, 'id') }}" wire:model="status.{{ data_get($model, 'id') }}"
        class="form-switch h-5 w-10 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white"
        type="checkbox" />
</label>
